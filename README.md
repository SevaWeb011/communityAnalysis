# communityAnalysis
application  for analysis of community vk.com

Цель проекта: 

Анализ активных подписчиков сообществ в vk.com

Создание на основе анализа выборки сообществ, которыми интересуется ваша активная аудитория.

______________________________________________________________________________________________
API социальной сети сильно ограничивают сбор общедоступной информации. В связи с этим есть смысл
собирать данные самостоятельно. Я сделаю приложение с запросами API,  их можно будет безболезненно изменить
на пользовательские запросы в будущем. Также придется отказаться от безопасной авторизации и написать прямую авторизацию. 

Сейчас дейтсвуют ограничени: 
1) Отсутствует выгрузка комментариев;
2) В день можно анализировать 3 сообщества с выгрузкой 300 записей со стены (если оно популярное, иначе больше возможностей);
3) Невозможно сделать приложение многопользовательским, если рассматривать его как веб-сервис (см. пункт 2);
______________________________________________________________________________________________

В файл libs/simple-php-vk-auth/config.php - пишите данные вашего vk приложения

В файл app/conf/config.php - данные вашей БД

файл .htaccess перенаправляет запросы на index.php, без него система перенаправлений работать не будет.

Возможно напишу документацию в будущем.

Если вдруг, чудо образом, захочешь принять участие в разработке, пиши malseva011@mail.ru

Был бы рад помощи в проектировании и разработке интерфейсов. 

А также любой другой помощи. 

