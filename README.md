
   Мини сайт, который содержит в себе помидоротаймер, регистрацию, индивидуальный для каждого пользователя блокнот.
Помидоротаймер реализован на JavaScript, регистрация и блокнот на PHP и MySQL(в базе данных созданы две таблицы:
users(id, login, password) и notepad(id, user_id, text).Сайт также содержит кое-какую адаптивность(переход происходит по
достижению 799px).

---------------------------------------
Название файла  | Содержание файла
----------------|----------------------
blocks(папка)	|  Содержит такие блоки, как  footer, head, header, menu
css(папка)      |  Каскадная таблица стилей
image(Папка)	|  Папка для изображений, которая содержит только пустой favicon.ico, чтобы браузер не ругался на его отсутстиве
changePassword.php| Смена пароля пользователя
createPost.php	| Создание записи в блокноте
index.php		| Главная страница сайта
login.php		| Авторизация
logout.php		| Выход из учетной записи
menu.js			| Всплывающее меню для мобильной версии сайта
notepad.php     | Блокнот
personalArea.php| Смена логина пользователя
pomidoro.php    | Помидоротаймер
register.php    | Регистрация
store.php       | Содержит скрипт обработчика блокнота
transform.php   | Изменение записи в блокноте