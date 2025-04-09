# Development & Deployment Workflow

## Table of Contents

1. [Development Workflow](#development-workflow)
    * [Setting Up Local Development with Docker](#setting-up-local-development-with-docker)
    * [Before Development - Project Management](#before-development---project-management)
    * [Typical Local Development Workflow with Docker](#typical-local-development-workflow-with-docker)
    * [Typical Theme Local Development Example](#typical-theme-local-development-example)
    * [Typical Content Development Example](#typical-content-development-example)
    * [After Development](#after-development)
    * [Automated PR Testing with GitHub Actions](#automated-pr-testing-with-github-actions)
2. [Deployment Workflow](#deployment-workflow)
    * [Staging Environment](#staging-environment)
        * [Initialising the Staging Web Server (Microsoft Azure) with Docker](#initialising-the-staging-web-server-microsoft-azure-with-docker)
        * [Initialising GitHub Actions for Staging](#initialising-github-actions-for-staging)
    * [Production Environment](#production-environment)
        * [Initialising the Production Web Server (Microsoft Azure) with Docker](#initialising-the-production-web-server-microsoft-azure-with-docker)
        * [Initialising GitHub Actions for Production](#initialising-github-actions-for-production)
        * [Manual Workflow of Updating Theme Code](#manual-workflow-of-updating-theme-code)
    * [Local to Staging](#local-to-staging)
    * [Staging to Production](#staging-to-production)

## Development Workflow

### Setting Up Local Development with Docker:

**Prerequisites:**

*   Git
*   Docker
*   Docker CLI (Linux)
*   Docker Compose
*   Docker Desktop (Windows, Mac)

**Steps:**

1.  Make sure a `docker-compose.yml` file is defined in the root directory:

    ```yaml
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

2.  Ensure that a `.env` file is defined in the root directory (for EXAMPLE):

    ```
    MYSQL_DATABASE = ninjawarriors
    MYSQL_USER = ninjawarrior
    MYSQL_PASSWORD = ninjawarrior_password
    MYSQL_ROOT_PASSWORD = ninjawarrior_root_password
    ```

3.  Create a `themes` directory in the root directory:

    ```
    mkdir themes
    ```

4.  Clone the repo (or a specific branch) in the directory:

    ```
    git clone https://github.com/cp3402-students/project-2025-tr1-jcua-team1.git
    ```

### Before Development - Project Management

1. Open Trello board:

  ```
  https://trello.com/b/dmD8yGCX
  ```

2. Create New Card in 'Next Actions' to reflect upcoming tasks 
    * Add a description of the task.
    * Add a due date, if relevant.

3. Move chosen card into 'In Progress' to notify team members.
    * Either drag or change list from the card description page.

4. Join the card you're working on, or assign team members to their respective cards.

### Typical Local Development Workflow with Docker:

1.  Fetch all changes:

    ```
    git fetch --all
    ```

2.  Pull all changes:

    ```
    git pull
    ```

3.  Create a new branch prior to modification (best practice).
4.  Run Docker containers:

    ```
    docker-compose up -d
    ```

5.  Stop Docker containers when finished:

    ```
    docker-compose down
    ```

### Typical Theme Local Development Example:

1.  Fetch all changes:

    ```
    git fetch --all
    ```

2.  Pull all changes:

    ```
    git pull
    ```

3.  Create a new branch prior to modification and switch into it (best practice) to separate working files from main files:
  
    ```
    git branch hompage-customisation
    git checkout -b homepage-customisation
    ```

4.  Run Docker containers:

    ```
    docker-compose up -d
    ```

5. Modify functions.php and front-page.php.

6. Publish branch:
  ```
  git push -u origin homepage-customisation
  ```

7. In Github, create a pull request.
    * Use a clear description of the changes for team members to review. 

8. Stop Docker containers when finished:

    ```
    docker-compose down
    ```


### Typical Content Development Example:

**Direct into staging website.**

1. Log into staging WordPress website as admin.

2. Add page and curate content.

3. Publish content.

4. Notify team.

**Local development export.**

1. Log into local WordPress website as admin.

2. Add page and curate content.

3. Publish content.

4. Export contents via WordPress built in export tool.
    * Select Pages
    * Apply additional filters if necessary 
    * .xml file will download

5. Import contents into staging website via WordPress built in import tool.
    * Run WordPress Importer from Import tab
    * Select downloaded .xml file of relevant content
    * Upload file and import
    * Assign posts to user 'shrek'
    * Select 'Download and import file attachments'
    * Submit
    * Verify that all content has been imported successfully, and identify any items that failed to import.

6. Notify team of changes made.

### After Development

1. Open Trello board:

  ```
  https://trello.com/b/dmD8yGCX
  ```

2. Mark chosen card as completed to notify team members.
    * Update description as relevant.


### Automated PR Testing with GitHub Actions

#### Initialising Automated PR Testing:

Automated PR testing using GitHub Actions currently helps ensure code quality by running PHP code tests before changes are merged to the main branch.

1.  Create `.github/workflows` directory in the repository if it doesn't exist:

2.  Create a workflow file for PR testing (for example): 

    ```
    .github/workflows/pr-testing.yml
    ```

3.  Add the following configuration to the workflow file:

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

          - name: Install PHP dependencies
            run: |
              if [ -f composer.json ]; then
                # Allow the required plugin
                composer config --no-plugins allow-plugins.dealerdirect/phpcodesniffer-composer-installer true
                # Install dependencies
                composer install --no-progress
              fi

          - name: PHP Lint
            run: |
              find . -name "*.php" -not -path "./vendor/*" -print0 | xargs -0 -n1 php -l

          - name: Run PHP Tests
            run: |
              if [ -f composer.json ] && grep -q "test" composer.json; then
                composer run test
              fi
    ```

4.  Commit and push the workflow file to the repository:

    ```
    git add .github/workflows/pr-testing.yml
    git commit -m "Add PR testing workflow"
    git push
    ```

#### How Pull Request Testing Works (Current):

1.  When a pull request is created against the `main` branch, GitHub Actions automatically runs the defined tests.
2.  The workflow checks for:

    *   PHP syntax errors

3.  Test results appear in the pull request interface on GitHub, showing whether all checks have passed.
4.  Failed tests should be addressed before merging the pull request to maintain code quality.

## Deployment Workflow

### Staging Environment

#### Initialising the Staging Web Server (Microsoft Azure) with Docker:

1.  Create a virtual machine (cost efficient technology).
    - Operating system: Linux (ubuntu 22.04)
    - Size: Standard B1ms (1 vcpu, 2 GiB memory)

2.  Download the key pair for SSH.

3.  SSH into the virtual machine (example):

    ```
    ssh -i wp-staging-key.pem azureuser@20.167.48.156
    ```

4.  Update the virtual machine:

    ```
    sudo apt update
    ```

5.  Install Docker:

    ```
    sudo apt install -y docker.io
    ```

6.  Enable and start Docker:

    ```
    sudo systemctl enable docker
    sudo systemctl start docker
    ```

7.  Install Docker Compose:

    ```
    sudo apt install -y docker-compose
    ```

8.  Create a .env file for passwords (in the desired directory):

    ```
    nano .env
    ```

9.  Define passwords with variables (for example):

    ```
    MYSQL_DATABASE = mysqldatabase
    MYSQL_USER = mysqluser
    MYSQL_PASSWORD = mysqlpassword
    MYSQL_ROOT_PASSWORD = sqlrootpassword
    ```

10. Create a docker-compose.yml file:

    ```
    nano docker-compose.yml
    ```

11. Define the docker-compose.yml file.
12. Start up containers:

    ```
    sudo docker-compose up -d
    ```

**Adding a custom theme:**

1.  Change directory into themes folder (create dir if needed).
2.  Clone the repo (or a specific branch) into the directory:

    ```
    sudo git clone https://github.com/cp3402-students/project-2025-tr1-jcua-team1.git
    ```

#### Initialising GitHub Actions for Staging Deployment:

1.  Add SSH private key and virtual machine IP address in GitHub repo's secrets.
2.  Define `.yml` file in `.github/workflows/` directory:

    ```yaml
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

#### Deploying site content:
1. Login to WordPress admin in local website.

2. Navigate to 'Tools'.

3. Select export and download file.

4. In the staging website, login to WordPress admin.

5. Import downloaded file.

### Production Environment

#### Initialising the Production Web Server (Microsoft Azure) with Docker:

1.  Create a virtual machine (cost efficient technology).
    - Operating system: Linux (ubuntu 22.04)
    - Size: Standard B1ms (1 vcpu, 2 GiB memory)

2.  Download the key pair for SSH access to the production virtual machine.

3.  SSH into the production virtual machine:

    ```
    ssh -i wp-production-key.pem azureuser@<PRODUCTION_VM_IP>
    ```

4.  Update the production virtual machine:

    ```
    sudo apt update
    ```

5.  Install Docker:

    ```
    sudo apt install -y docker.io
    ```

6.  Enable and start Docker:

    ```
    sudo systemctl enable docker
    sudo systemctl start docker
    ```

7.  Install Docker Compose:

    ```
    sudo apt install -y docker-compose
    ```

8.  Create a .env file for passwords (in the desired directory):

    ```
    nano .env
    ```

9.  Define passwords with variables (example):

    ```
    MYSQL_DATABASE = mysqldatabase
    MYSQL_USER = mysqluser
    MYSQL_PASSWORD = mysqlpassword
    MYSQL_ROOT_PASSWORD = mysqlrootpassword
    ```

10. Create a docker-compose.yml file:

    ```
    nano docker-compose.yml
    ```

11. Define the docker-compose.yml file (ensure it's configured for production).
12. Start up the containers:

    ```
    sudo docker-compose up -d
    ```

**Adding a custom theme:**

1.  Change directory into themes folder (create dir if needed).
2.  Clone the repo (or a specific branch) into the directory:

    ```
    sudo git clone https://github.com/cp3402-students/project-2025-tr1-jcua-team1.git
    ```

#### Initialising GitHub Actions for Production:

1.  Add SSH private key and virtual machine IP address in GitHub repo's secrets (create new secrets for production).
2.  Define `.yml` file in `.github/workflows/` directory:

    ```yaml
    name: Deploy WordPress Theme to Azure Production VM

    on:
      push:
        branches:
          - production

    jobs:
      deploy:
        runs-on: ubuntu-latest

        steps:
          - name: Checkout code
            uses: actions/checkout@v3

          - name: Set up SSH Key
            run: |
              mkdir -p ~/.ssh
              echo "${{ secrets.SSH_PRIVATE_KEY_PRODUCTION }}" > ~/.ssh/id_rsa
              chmod 600 ~/.ssh/id_rsa
              ssh-keyscan -H ${{ secrets.PRODUCTION_VM_IP }} >> ~/.ssh/known_hosts

          - name: Deploy Theme to Azure VM
            run: |
              ssh azureuser@${{ secrets.PRODUCTION_VM_IP }} << 'EOF'
                cd ~/wp/themes/project-2025-tr1-jcua-team1  # Adjust this path to your WordPress theme directory
                sudo git pull origin production  # Fetch latest changes from production branch
              EOF
    ```

#### Manual Workflow of Updating Theme Code (Staging or Production):

1.  Commit and push changes from local development to the `main` for staging and `production` for production.

2.  SSH into virtual machine:

    ```
    ssh -i wp-production-key.pem azureuser@<PRODUCTION_VM_IP>
    ```

3.  Change directory into the custom theme folder.
4.  Fetch all changes:

    ```
    git fetch --all
    ```

5.  Pull all changes:

    ```
    git pull
    ```

#### Deploying site content:
1. Login to WordPress admin in stagin website.

2. Navigate to 'Tools'.

3. Select export and download file.

4. In the production website, login to WordPress admin.

5. Import downloaded file.


### Local to Staging:

Any pushes to main will automatically be deployed in the staging website via Github Actions as defined above.

### Staging to Production:

1. Checkout the production branch in your chosen code editor:
  ```
  git checkout production
  ```

2. Merge main into the production branch:
  ```
  git merge main
  ```

3. Push changes to production:
  ```
  git push origin production
  ```

4. GitHub actions will trigger and pull the changes in the production virtual machine.
