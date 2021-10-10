# Task Planner OS

Task Planner OS is the community edition of Task Planner, and is free to use for your own projects. It will help you easily prioritize your daily and ongoing tasks. If you are interested in the hosted version and its additional professional features, visit [Task Planner PRO](https://larajam.a-5.dev/).

## Simple and powerful features including:

- Tasks with due dates, or simple lists
- **PRO Features**
    - Recurring Tasks
    - Drag and drop tasks between dates and lists
    - Email, SMS, and push notifications and reminders
    - Uses different colors for quick visual organization

## Requirements
- PHP 8.0+
- Node 14.18.0

## Installation

1. Create a web accessible folder.

2. From within the web folder:
    ``` bash
    $ git clone https://github.com/a5-dev/task-planner.git .
    $ composer install
    $ cp .env.example .env
    $ php artisan key:generate
    ```

3. Edit your database configuration in `.env`.

4. Migrate the database:
    ``` bash
    $ php artisan migrate
    ```

5. Setup Node:
    If you have NVM, an `.nvmrc` file is provided:
    ```
    $ nvm use
    ```

    otherwise, install the node version noted in the `.nvmrc` file:
    ```
    $ cat .nvmrc
    ```

    Verify your node version (14.18.0):
    ```
    node -v
    ```

6. Install NPM modules and compile assets: 
    ``` bash
    $ npm install
    $ npm run prod
    ```

7. Make sure your web server is pointed to the newly created public folder.

8. Open your browser.

## Usage

**No additional configuration is required.** You can now open the webpage and click the register link in the top right corner.

## Seeding _(optional)_
You can seed your first user with some sample data by using `php artisan db:seed`. The seeder with create an sample user with username `user@example.com` and password `password`.

## Demo
[Larajam Demo](https://larajam.a-5.dev/)

## Contributing

[A5](https://a-5.dev) - Abdel and Daniel

## License

The task Planner OS is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
