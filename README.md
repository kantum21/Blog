# Blog
Projet 5 - Formation développeur d'applications PHP/Symfony

SetUp Instructions

1. Get Project : git clone https://github.com/kantum21/Blog.git
2. Install dependencies : composer install
3. Configure environment : in config/prod.php define correct values according to your environment
4. Activate environment settings : in public/index.php replace require '../config/dev.php'; by require '../config/prod.php';
5. Get Database : load dump.sql
6. Disable debug and active cache : Follow TODO in src/controller/Controller.php  