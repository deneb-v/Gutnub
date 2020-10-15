# Gutnub

Gutnub not github

## Requirement
- [XAMPP](https://www.apachefriends.org/index.html)
- [Composer](https://getcomposer.org/download/)
- [Google API project](https://console.developers.google.com/apis/dashboard)

## Create Google API project
1. Open https://console.developers.google.com/apis/dashboard then create new project
    ![create project](https://drive.google.com/uc?export=view&id=1BtQYRDIOXvi86nDUw2qlvDqbAtmrtEbD)
2. Enable Google Drive API
    ![enable drive api](https://drive.google.com/uc?export=view&id=1hlXiXQwC09OYzMhhK56sj6LbxCmq5UVa)
    ![enable drive api2](https://drive.google.com/uc?export=view&id=1CF6lASQuNTvf2hO-bZg8sT0MDyBIgU6l)
3. Configure OAuth consent screen
    - Choose external user type
        ![configure OAuth consent screen](https://drive.google.com/uc?export=view&id=1X5sNxinUD-JRlfsmtIMowkq3UMZORxo_)
    - Fill application name then save OAuth consent screen
        ![configure OAuth consent screen 2](https://drive.google.com/uc?export=view&id=1TNiMWEWuFM5TR3zAGGe2X-qK2o3uyj8N)
4. Create new credential
    - Choose OAuth Client ID
        ![Credential 1](https://drive.google.com/uc?export=view&id=1zbuLb4ire2dMaDC88R--dBpOtHH9Gx-r)
    - Choose application type as web application then fill the application name, then add authorized javascript origin url `http://127.0.0.1:8000` and authorized redirect URL `http://127.0.0.1:8000/auth/google/redirect` 
        ![Credential 2](https://drive.google.com/uc?export=view&id=1Z5x9bpic8d5HBxWeo8B5HfTZyY_25Mz8)
    - Save Client ID and Client Secret
        ![Credential 3](https://drive.google.com/uc?export=view&id=12DivzfF1svmM7KKMn9hWhxAZHkLbju0q)

## First time configuration
1. Open XAMPP control panel then start Apache and Mysql module.
2. Open http://localhost/phpmyadmin/ then create new database for this project.
3. Clone / download this project.
4. Open project file folder and duplicate `.env.example` file.
5. Rename the duplicated file to `.env` then open the file.
6. Look for this section at `.env` file
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```
7. Replace `DB_DATABASE=laravel` into `DB_DATABASE=[The Database Name That You Created]` (example: `DB_DATABASE=gutnub`).
8. Look for this section at `.env` file
    ```
    GOOGLE_APP_ID=[YOUR PROJECT ID]
    GOOGLE_CLIENT_ID=[YOUR CLIENT ID]
    GOOGLE_CLIENT_SECRET=[YOUR CLIENT SECRET]
    GOOGLE_REDIRECT='http://127.0.0.1:8000/auth/google/redirect'
    ```
9. Replace `[YOUR PROJECT ID]` with your Google API project ID.
10. Replace `[YOUR CLIENT ID]` to the client ID that was saved earlier.
11. Replace `[YOUR CLIENT SECRET]` to the client secret that was saved earlier 
12. Open Command Prompt at this project file directory.
13. Run this command
    ```
    composer install
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    ```

## How to run this project
1. Open XAMPP control panel then start Apache and Mysql module.
2. Open Command Prompt at the project file directory.
3. Run this command
    ```
    php artisan serve
    ```
    Now you can open this project at http://127.0.0.1:8000.
