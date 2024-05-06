# CISC3003 Web Programming Project Assignment - Team Part
## Project: Campus Q&A
**Team 04**
- Pair 06
    - Huang Yanzhen, DC126732
    - Li Ruoxuan, DC0275434
- Pair 04
    - Chen Zirui, DC127901
    - Guo Pengze, DC127461
- Pair 24
    - Chen Pengyu, DC125135
    - Lei Chon Hin, DC026736

GitHub Repo: https://github.com/YanzhenHuang/CISC3003-Final-Project

## Project Setup:
1. **Prerequisits:** Make sure you have installed XAMPP, and have the Apache Server & MySQL Server included. Clone this project into the `htdocs` folder to make sure you are able to access it.

2. **Run Server:** Run the Apache Server and MySQL by clicking both start buttons in the XAMPP Control Panel.

3. **Initialize Database:** Open `localhost/phpmyadmin`, click "New" button on the left side to create a new database. Name this database as `qadb`. This name is used for configuration in PHP so it should not be changed.

4. **Import the Database files:** Click the "Import" button on the top right side of the page. Click "Choose File", and direct to this git repository you cloned/downloaded, and find the database files in the [tables](./tables/) directory. Select an `.sql` file, and click "Import", you will import the corresponding table into your database. There are three files:
- [qa_user.sql](./tables/qa_user.sql)
- [post.sql](./tables/post.sql)
- [reply.sql](./tables/reply.sql)

You need to import them in the following order:
`qa_user.sql`, `post.sql`, `reply.sql`.

5. **Mail Configuration:** The PHPMailer module uses SMTP to send emails, and the SMTP service is provided by Gmail for our project with the unique token. If it doesn't work on your computer, you need to configure your own SMTP service. The configuration file is in [send-email.php](./public/php/utils/send-email.php).

## Sample Accounts and Passwords
User Name: password
- Admin: abc
- Guo Pengze: abc
- Li Ruoxuan: 123456
- Foster Chen Pengyu: abc
- Chen Zirui: abc