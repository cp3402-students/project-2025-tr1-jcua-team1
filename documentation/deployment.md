# Development & Deployment workflow

## Development workflow

### Setting up local development with Docker:
**Pre-requisites:**
- Git
- Docker
- Docker cli (Linux)
- Docker compose
- Docker desktop (Windows, Mac)

**Steps:**

1. Make sure a docker-compose.yml file is defined in the root directory like this:
    ```
    services:
    database:
        container_name: db-ninjawarriors
        mem_reservation: 2048m
        image: mysql
        restart: unless-stopped
        ports:
        - 3306:3306
        env_file: .env
        environment:
        MYSQL_ROOT_PASSWORD: '${MYSQL_ROOT_PASSWORD}'
        MYSQL_DATABASE: '${MYSQL_DATABASE}'
        MYSQL_USER: '${MYSQL_USER}'
        MYSQL_PASSWORD: '${MYSQL_PASSWORD}'
        volumes:
        - db_data:/var/lib/mysql
        networks:
        wordpress-network:

    wordpress:
        container_name: wp-ninjawarriors
        depends_on:
        - database
        image: wordpress:latest
        restart: unless-stopped
        ports:
        - 8080:80
        env_file: .env
        environment:
        WORDPRESS_DB_HOST: database:3306
        WORDPRESS_DB_NAME: '${MYSQL_DATABASE}'
        WORDPRESS_DB_USER: '${MYSQL_USER}'
        WORDPRESS_DB_PASSWORD: '${MYSQL_PASSWORD}'
        volumes:
        - wordpress_data:/var/www/html      # Persistent storage for WordPress core files
        - ./themes:/var/www/html/wp-content/themes    # Local development of themes
        - ./plugins:/var/www/html/wp-content/plugins  # Local development of plugins
        - ./uploads:/var/www/html/wp-content/uploads  # Store uploaded media files locally
        networks:
        - wordpress-network
        
    volumes:
    db_data: 
    wordpress_data:

    networks:
    wordpress-network:
        driver: bridge

    ```

2. Ensure that a '.env' file is defined in the root directory.
    ```
    MYSQL_DATABASE = ninjawarriors
    MYSQL_USER = ninjawarrior
    MYSQL_PASSWORD = ninjawarrior_password
    MYSQL_ROOT_PASSWORD = ninjawarrior_root_password
    ```

3. Create a 'themes' directory in root directory:
    ```
    mkdir themes
    ```

4. Clone the repo (or a specific branch) in directory:
    ```
    git clone https://github.com/cp3402-students/project-2025-tr1-jcua-team1.git
    ```

### Typical local development workflow with Docker:
1. Fetch all changes:
    ```
    git fetch --all
    ```

2. Pull all changes:
    ```
    git pull
    ```

3. Create new branch prior to modification (best practice).

4. Run Docker containers:
    ```
    docker-compose up -d
    ```

5. Destroy Docker containers when finished:
    ```
    docker-compose down
    ```

### Automated PR testing with Github Actions

#### Initialising automated PR testing:
Automated PR testing using GitHub Actions helps ensure code quality by running tests before changes are merged to the main branch.

1. Create `.github/workflows` directory in the repository if it doesn't exist:
   ```
   mkdir -p .github/workflows
   ```

2. Create a workflow file for PR testing:
   ```
   nano .github/workflows/pr-testing.yml
   ```

3. Add the following configuration to the workflow file:
   ```yaml
   name: Test Pull Request

   on:
     pull_request:
       branches:
         - main

   jobs:
     test:
       runs-on: ubuntu-latest
       
       steps:
       - name: Checkout code
         uses: actions/checkout@v3
         
       - name: Set up PHP
         uses: shivammathur/setup-php@v2
         with:
           php-version: '8.0'
           extensions: mbstring, xml
           coverage: none
           
       - name: Set up Node.js
         uses: actions/setup-node@v3
         with:
           node-version: '16'
           
       - name: Install PHP dependencies
         run: |
           if [ -f composer.json ]; then
             composer config --no-plugins allow-plugins.dealerdirect/phpcodesniffer-composer-installer true
             composer install --no-progress
           fi
           
       - name: Install JS dependencies
         run: |
           if [ -f package.json ]; then
             if [ -f package-lock.json ]; then
               npm ci
             else
               npm install
             fi
           fi
           
       - name: PHP Lint
         run: |
           find . -name "*.php" -not -path "./vendor/*" -print0 | xargs -0 -n1 php -l
           
       - name: Run JavaScript/CSS linting
         run: |
           if [ -f package.json ]; then
             if npm run --silent --if-present | grep -q "^  lint"; then
               npm run lint
             else
               echo "No lint script found in package.json. Skipping linting step."
             fi
           else
             echo "No package.json found. Skipping JavaScript/CSS linting."
           fi
           
       - name: Run tests
         run: |
           if [ -f composer.json ] && grep -q "test" composer.json; then
             composer run test
           elif [ -f package.json ] && grep -q "test" package.json; then
             npm test
           fi
   ```

4. Commit and push the workflow file to the repository:
   ```
   git add .github/workflows/pr-testing.yml
   git commit -m "Add PR testing workflow"
   git push
   ```

#### How PR testing works:
1. When a pull request is created against the main branch, GitHub Actions automatically runs the defined tests.
2. The workflow checks:
   - PHP syntax errors
   - Code linting (if configured)
   - Unit tests (if configured)
3. Test results appear in the PR interface on GitHub, showing whether all checks have passed.
4. Failed tests should be addressed before merging the PR to maintain code quality.

## Deployment workflow

### Initialising the staging web server (Microsoft Azure) with Docker:

1. Create virtual machine using chosen service provider.

2. Download key pair for SSH.

3. SSH into VM:
    ```
    ssh -i wp-staging-key.pem azureuser@20.167.48.156
    ```

4. Update VM:
    ```
    sudo apt update
    ```

5. Install Docker:
    ```
    sudo apt install -y docker.io
    ```

6. Enable and start Docker:
    ```
    sudo systemctl enable docker
    sudo systemctl start docker
    ```

7. Install Docker Compose:
    ```
    sudo apt install -y docker-compose
    ```

8. Create .env file for passwords (in desired directory):
    ```
    nano .env
    ```

9. Define passwords with variables (for example):
    ```
    MYSQL_DATABASE = ninjawarriors
    MYSQL_USER = ninjawarrior
    MYSQL_PASSWORD = ninjawarrior_password
    MYSQL_ROOT_PASSWORD = ninjawarrior_root_password
    ```

10. Create docker-compose.yml file:
    ```
    nano docker-compose.yml
    ```

11. Define docker-compose.yml file.

12. Start up containers:
    ```
    sudo docker-compose up -d
    ```

**Adding custom theme:**

13. Change directory into themes (create dir if needed).

14. Clone the repo (or a specific branch) in directory:
    ```
    git clone https://github.com/cp3402-students/project-2025-tr1-jcua-team1.git
    ```


### Initialise Github actions (updating theme code workflow) in staging server:

1. Add SSH private key and VM IP address in Github repo's secrets.

2. Define .yml file in .github/workflows/ directory:
    ```
    name: Deploy WordPress Theme to Azure Staging VM

    on:
    push:
        branches:
        - main 

    jobs:
    deploy:
        runs-on: ubuntu-latest

        steps:
        - name: Checkout code
        uses: actions/checkout@v3

        - name: Set up SSH Key
        run: |
            mkdir -p ~/.ssh
            echo "${{ secrets.SSH_PRIVATE_KEY_STAGING }}" > ~/.ssh/id_rsa
            chmod 600 ~/.ssh/id_rsa
            ssh-keyscan -H ${{ secrets.STAGING_VM_IP }} >> ~/.ssh/known_hosts

        - name: Deploy Theme to Azure VM
        run: |
            ssh azureuser@${{ secrets.STAGING_VM_IP }} << 'EOF'
            cd ~/wp/themes/project-2025-tr1-jcua-team1  # Adjust this path to your WordPress theme directory
            git pull origin main  # Fetch latest changes
            EOF
    ```



### Manual workflow of updating theme code:

1. Commit and push changes from local development.

2. SSH into VM:
    ```
    ssh -i wp-staging-key.pem azureuser@20.167.48.156
    ```

3. Change directroy into custom theme folder
    
4. Fetch all changes:
    ```
    git fetch --all
    ```

5. Pull all changes:
    ```
    git pull
    ```