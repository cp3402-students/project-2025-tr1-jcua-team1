# Development & Deployment workflow

## Development workflow

### Setting up local development with Docker:
**Pre-requisites:**
- Git
- Docker
- Docker cli (Linux)
- Docker compose
- Docker desktop (Windows, Mac)
- WordPress core files

**Workflow:**
1. Make sure a docker-compose.yml file is defined in the root WordPress directory like this:
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
        image: wordpress
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
        - ./:/var/www/html
        networks:
        - wordpress-network
        
    volumes:
    db_data: 

    networks:
    wordpress-network:
        driver: bridge

    ```

2. Ensure that a '.env' file is defined in the root WordPress directory.

3. Clone the repo in the wp-content/themes directory:
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

3. Create new branch prior to modification.

4. Run Docker containers:
    ```
    docker-compose up -d
    ```

5. Destroy Docker containers:
    ```
    docker-compose down
    ```