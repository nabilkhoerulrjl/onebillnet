# .env.staging

# Set default values Information Server
SERVER_ADDRESS=$DEPLOY_SERVER_ADDRESS
DEPLOY_DIR=$DEPLOY_DIR
GITHUB_USERNAME=$GITHUB_USERNAME
GITHUB_TOKEN=$GITHUB_TOKEN
ACTIVE_BRANCH=$(git rev-parse --abbrev-ref HEAD)

# Parse command line arguments Check ENVIRONMENT USE
while [[ $# -gt 0 ]]; do
    case "$1" in
        --environment|-e)
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
    source <(dotenv -e .env."$ENVIRONMENT")
else
    echo "Environment not specified. Use --environment flag."
    exit 1
fi

# Set up Git credentials for HTTPS
git_credential_helper="!f() { echo \"username=${GITHUB_USERNAME}\"; echo \"password=${GITHUB_TOKEN}\"; }; f"
git config --global credential.helper "$git_credential_helper"

# Pull latest changes from GitHub repository
# source <(/mnt/c/Users/nabil/AppData/Roaming/npm/dotenv -e .env."$ACTIVE_BRANCH")
cd "$DEPLOY_DIR" && git pull origin "$ACTIVE_BRANCH"
