<?php
function menu($type)
{ // $type = "main | student | admin | super_admin | hoster ", config.php needs to be included before
    global $http_adress, $site_name, $lib_change_link, $admin_page_name, $langLink;
    $http = $http_adress;

//-----------------
// MAIN
//-----------------


    if ($type == "main") {
        echo "
        <nav class='navigation-bar dark fixed-top'>
        <nav class='navigation-bar-content'>
        <a class = 'element' href='$http'>ELib</a>
        <span class='element-divider'></span>
        <span class='element-divider place-right'></span>
        <div class='element place-right'>
        <a class='dropdown-toggle' href='#'> "._("Авторизация")." <span class='icon-locked on-right-more'></span></a>
        <ul class='dropdown-menu dark ' data-role='dropdown'>
        <li><a href='$http_adress/admin'> "._("Библиотекарь")." </span></a></li>
        <li><a href='$http_adress/account/auth.php'> "._("Читатель")." </a></li>

        </ul>
        </div>
        $lib_change_link
        <span class='element-divider place-right'></span>
        $langLink
        </nav>
        </nav>
        ";
    }


//-----------------
// STUDENT
//-----------------


    if ($type == "student") {
        $id = $_SESSION['student']['id'];
        echo "
        <nav class='navigation-bar dark fixed-top'>
        <nav class='navigation-bar-content'>
        <a class = 'element' href='$http'>ELib "._("Читатель")."</a>
        <span class='element-divider'></span>
        <a class='element brand' href='$http/public/all_books.php'><span class='icon-book on-left'></span>"._("Книги")."</a>
        <a class='element brand' href='$http/public/rating.php'><span class='icon-user on-left'></span>"._("Ученики")."</a>
        <span class='element-divider'></span>
        <a class='element' href='$http_adress/public/depts2.php'><span class='icon-warning on-left'></span>"._("Долги")."</a>
        <span class='element-divider'></span>
        <span class='element-divider place-right'></span>
        <div class='element place-right'>
        <a class='dropdown-toggle' href='#'> "._("Мой Аккаунт")." <span class='icon-unlocked on-right-more'></span></a>
        <ul class='dropdown-menu dark ' data-role='dropdown'>
        <li><a href='$http_adress/account/info.php'> "._("Редактировать")." </a></li>
        <li class='divider'></li>
        <li><a href='$http_adress/public/student.php?id=$id&show=1'> "._("Книги")." <span class='icon-book on-right'></span></a></li>
        <li><a href='$http_adress/public/student.php?id=$id&show=2'> "._("История")." <span class='icon-clock on-right'></span></a></li>
        <li class='divider'></li>
        <li><a href='$http_adress/account/logout.php'> "._("Выйти")." <span class='icon-locked on-right-more'></span></a></li>

        </ul>
        </div>
        $lib_change_link
        <span class='element-divider place-right'></span>
        $langLink
        </nav>
        </nav>
        ";
    }


//-----------------
// ADMIN
//-----------------


    if ($type == "admin") {
        echo "
        <nav class='navigation-bar dark fixed-top'>
        <nav class='navigation-bar-content'>
        <a class = 'element 'href='$http_adress/admin'>"._("ELib Библиотекарь")."</a>
        <span class='element-divider'></span>

        <a class='element' href='#'><span class='icon-user on-left'></span>"._("Ученики")." </a>
        <div class='element'>
        <a class='dropdown-toggle' href='#'><span class='icon-book on-left'></span>"._("Книги")." </a>
        <ul class='dropdown-menu dark' data-role='dropdown'>
        <li><a href='$http_adress/public/all_books.php'>"._("Все Книги")." </a></li>
        <li class = 'divider'> </li>
        <li><a href='$http_adress/admin/books/br/show.php' target = '_blank'> "._("Приём/Выдача")." <i class=' icon-tab on-right'></i> </a></li>
        </ul>
        </div>
        <div class='element'>
        <a class='dropdown-toggle' href='#'><i class='fa fa-qrcode on-left'></i></span> "._("QR")." </a>
        <ul class='dropdown-menu dark' data-role='dropdown'>
        <li><a href='$http_adress/admin/books/br/webqr.php' target = '_blanc'> "._("Считыватель")." <i class='fa fa-video-camera on-right'></i> </a></li>
        <li><a href='$http_adress/admin/books/br/qr_gen.php' target = '_blanc'> "._("Генератор")." <i class='fa fa-print on-right'></i> </a></li>
        <li><a href='$http_adress/admin/books/br/qr_gen_lite.php' target = '_blanc'> "._("Генератор Lite")." <i class='fa fa-print on-right'></i> </a></li>
        </ul>
        </div>
        <span class='element-divider'></span>
        <a class='element' href='$http_adress/admin/books/all_history.php'><span class='icon-clock on-left'></span>"._("Вся история")."</a>
        <a class='element' href='$http_adress/public/depts2.php'><span class='icon-warning on-left'></span>"._("Долги")."</a>
        <span class='element-divider'></span>

        <span class='element-divider'></span>

        <span class='element-divider place-right'></span>
        <div class='element place-right'>
        <a class='dropdown-toggle' href='#'>"._("Библиотекарь")." <span class='icon-unlocked on-right-more'></span></a>
        <ul class='dropdown-menu dark ' data-role='dropdown'>
        <li><a href='$http_adress'>"._("Главная")." <span class = 'icon-forward on-right'> </span></a></li>
        <li><a href='$http_adress/public/student.php?id=-1&show=2'>"._("История")." <span class = 'icon-clock on-right'> </span></a></li>
        <li class='divider'></li>
        <li><a href='$http_adress/admin/logout.php'>"._("Выйти")." <span class = 'icon-locked on-right'></span></a></li>
        </ul>
        </div>
        <span class='element-divider place-right'></span>
        $lib_change_link
        <span class='element-divider place-right'></span>
        $langLink
        </nav>
        </nav>
        ";
    }


//-----------------
// SUPER ADMIN
//-----------------


    if ($type == "super") {
        echo "
        <nav class='navigation-bar dark fixed-top'>
        <nav class='navigation-bar-content'>
        <a class = 'element 'href='$http_adress/admin'>ELib "._("Библиотекарь")." <span class = 'icon-plus-2 on-right'></a>
        <span class='element-divider'></span>
        <div class='element'>
        <a class='dropdown-toggle' href='#'><span class='icon-user on-left'></span>"._("Ученики")." </a>
        <ul class='dropdown-menu dark' data-role='dropdown'>
        <li><a href='$http_adress/admin/books/all_students.php'>"._("Все ученики ")."</a></li>
        <li><a href='$http_adress/admin/books/add_student.php'> "._("Добавить")." </a></li>
        </ul>
        </div>
        <div class='element'>
        <a class='dropdown-toggle' href='#'><span class='icon-book on-left'></span>"._("Книги")." </a>
        <ul class='dropdown-menu dark' data-role='dropdown'>
        <li><a href='$http_adress/public/all_books.php'>"._("Все Книги")." </a></li>
        <li><a href='$http_adress/admin/books/add_book_db.php'> "._("Добавить")." </a></li>
        <li class = 'divider'> </li>
        <li><a href='$http_adress/admin/books/br/show.php' target = '_blank'> "._("Приём/Выдача")." <i class=' icon-tab on-right'></i> </a></li>
        </ul>
        </div>
        <div class='element'>
        <a class='dropdown-toggle' href='#'><i class='fa fa-qrcode on-left'></i></span> "._("QR")." </a>
        <ul class='dropdown-menu dark' data-role='dropdown'>
        <li><a href='$http_adress/admin/books/br/webqr.php' target = '_blanc'> "._("Считыватель")." <i class='fa fa-video-camera on-right'></i> </a></li>
        <li><a href='$http_adress/admin/books/br/qr_gen.php' target = '_blanc'> "._("Генератор")." <i class='fa fa-print on-right'></i> </a></li>
        <li><a href='$http_adress/admin/books/br/qr_gen_lite.php' target = '_blanc'> "._("Генератор Lite")." <i class='fa fa-print on-right'></i> </a></li>
        </ul>
        </div>
        <span class='element-divider'></span>
        <a class='element' href='$http_adress/admin/books/all_history.php'><span class='icon-clock on-left'></span>"._("Вся история")."</a>
        <a class='element' href='$http_adress/public/depts2.php'><span class='icon-warning on-left'></span>"._("Долги")."</a>
        <span class='element-divider'></span>
        <div class='element'>
        <a class='dropdown-toggle' href='#'><span class='icon-database on-left'></span> "._("Импортирование")." </a>
        <ul class='dropdown-menu dark' data-role='dropdown'>
        <li><a href='$http_adress/admin/books/manip/import.php'> "._("Быстрое добавление")." </a></li>
        </ul>
        </div>
        <span class='element-divider'></span>

        <span class='element-divider place-right'></span>
        <div class='element place-right'>
        <a class='dropdown-toggle' href='#'>"._("Библиотекарь")." <span class='icon-unlocked on-right-more'></span></a>
        <ul class='dropdown-menu dark ' data-role='dropdown'>
        <li><a href='$http_adress'>"._("Главная")." <span class = 'icon-forward on-right'> </span></a></li>
        <li><a href='$http_adress/public/student.php?id=-1&show=2'>"._("История")." <span class = 'icon-clock on-right'> </span></a></li>
        <li class='divider'></li>
        <li><a href='$http_adress/admin/users.php'>"._("Пользователи")." <span class = 'icon-user-3'> </a></li>
        <li class='divider'></li>
        <li><a href='$http_adress/admin/logout.php'>"._("Выйти")." <span class = 'icon-locked on-right'></span></a></li>
        </ul>
        </div>
        <span class='element-divider place-right'></span>
        $lib_change_link
        <span class='element-divider place-right'></span>
        $langLink
        </nav>
        </nav>
        ";
    }


//-----------------
// HOSTER
//-----------------


    if ($type == "hoster") {
        echo "
        <nav class='navigation-bar dark fixed-top'>
        <nav class='navigation-bar-content'>
        <a class = 'element 'href='$http_adress/select_lib/admin.php'>ELib "._("Администратор")."</a>
        <span class='element-divider'></span>
        <div class='element'>
        <a class='dropdown-toggle' href='#'></span>"._("Библиотеки")." </a>
        <ul class='dropdown-menu dark' data-role='dropdown'>
        <li><a href='$http_adress/select_lib/al_libs.php'>"._("Все Библиотеки")." </a></li>
        <li><a href='$http_adress/select_lib/add.php'> "._("Добавить")." </a></li>
        </ul>
        </div>
        <div class='element'>
        <a class='dropdown-toggle' href='#'><span class='icon-folder-2 on-left'></span>"._("Файлы")." </a>
        <ul class='dropdown-menu dark' data-role='dropdown'>
        <li><a href='$http_adress/select_lib/fmanager/monsta'>File Manager FTP</a></li>
        <li><a target = '_blank' href='$http_adress/select_lib/fmanager/pfm'>PFM<span class='icon-star on-right'></span> </a></li>
        <li><a target = '_blank' href='$http_adress/select_lib/fmanager/dir2.php'> File Manager LITE </a></li>
        </ul>
        </div>
        <span class='element-divider'></span>
        <a class='element' href='$http_adress/select_lib/show_settings.php'><span class='icon-cog on-left'></span>"._("Информация")."</a>
        <span class='element-divider'></span>
        <span class='element-divider place-right'></span>
        <div class='element place-right'>
        <a class='dropdown-toggle' href='#'>"._("Администратор")." <span class='icon-unlocked on-right-more'></span></a>
        <ul class='dropdown-menu dark ' data-role='dropdown'>
        <li><a href='$http_adress'>"._("Главная")." <span class = 'icon-forward on-right'> </span></a></li>
        <li class='divider'></li>
        <li><a href='$http_adress/select_lib/logout.php'>"._("Выйти")." <span class = 'icon-locked on-right'></span></a></li>
        </ul>
        </div>
        <span class='element-divider place-right'></span>
        $langLink
        </nav>
        </nav>
        ";
            }
            echo "<br><br><br>";
        }

?>
