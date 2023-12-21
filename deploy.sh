# .env.staging

# Set default values Information Server
SERVER_ADDRESS=$DEPLOY_SERVER_ADDRESS
GITHUB_USERNAME=$GITHUB_USERNAME
GITHUB_TOKEN=$GITHUB_TOKEN
REMOTE_HOST=$REMOTE_HOST
REMOTE_USER=$REMOTE_USER
DEPLOY_PATH=$DEPLOY_PATH

# REMOTE_HOST='192.168.0.122'
# REMOTE_USER='webserver1'
# DEPLOY_PATH='/var/www/onebillnet'
ACTIVE_BRANCH=$(git rev-parse --abbrev-ref HEAD)

# Parse command line arguments Check ENVIRONMENT USE
while [[ $# -gt 0 ]]; do
    case "$1" in
        --env|-e)
            shift
            ENVIRONMENT=$1
            ;;
        *)
            echo "Invalid argument: $1"
            exit 1
            ;;
    esac
    shift
done

# Load environment-specific configuration from .env
if [ -n "$ENVIRONMENT" ]; then
    source .env."$ENVIRONMENT"
else
    echo "Environment not specified. Use --environment flag."
    exit 1
fi

# Proses deploy
# echo "Mengunggah ke server..."
# scp -r $LOCAL_PATH $REMOTE_USER@$REMOTE_HOST:$REMOTE_PATH  || { echo "Gagal mengunggah ke server."; exit 1; }

echo "Login to server..."
ssh $(echo "$REMOTE_USER" | tr -d '\r')@$(echo "$REMOTE_HOST" | tr -d '\r') "cd $(echo "$DEPLOY_PATH" | tr -d '\r')" || { echo "$REMOTE_HOST"; exit 1; }
echo "Success login to server..."

# Set up Git credentials for HTTPS
echo "Setup..."
git_credential_helper="!f() { echo \"username=${GITHUB_USERNAME}\"; echo \"password=${GITHUB_TOKEN}\"; }; f"
git config --global credential.helper "$git_credential_helper"

echo "Pull latest code..."
sudo git pull origin "$ACTIVE_BRANCH" || { echo "Gagal pull latest code."; exit 1; }
echo "Success pull latest code..."


# Pull latest changes from GitHub repository
# source <(/mnt/c/Users/nabil/AppData/Roaming/npm/dotenv -e .env."$ACTIVE_BRANCH")
# cd $(echo "$DEPLOY_PATH" | tr -d '\r') && sudo -u webserver1 git pull origin "$ACTIVE_BRANCH"

#echo "Menjalankan skrip setup di server..."
#ssh $REMOTE_USER@$REMOTE_HOST "cd $DEPLOY_PATH && sudo -u webserver1 ./deploy.sh"

echo "Deploy selesai."
