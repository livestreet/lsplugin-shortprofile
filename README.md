Плагин "Short Profile" для LiveStreet 1.0
=========================================
Версия 1.0.1

**Необходимая версия LiveStreet >= 1.0**

Позволяет делать короткие урлы для для профилей пользователя: http://site.ru/profile/claus/ -> http://site.ru/claus/

Но нужно понимать, что такой подход будет конфликтовать с вашими стандартными адресами, если с ними совпадает имя пользователя.
Например, профиль пользователя "admin" не будет работать, вместо него будет открываться админка сайта.

Есть два способа избежать этого:
* Запретить регистрацию пользователей с определенными логинами
* Сделать в конфиге реврайты определенных адресов, например, для админки можно было прописать в конфиге: `$config['router']['rewrite'] = array('admin'=>'my_admin');`
	Тогда по адресу /admin/ будет доступен профиль пользователя, а админка будет работать по адресу /my_admin/


ВНИМАНИЕ!
=========
Плагин не рекомендуется к использованию, т.к. поддвергает ваш сайт конфликтам URL (читай выше)


ИСТОРИЯ
=========
* 1.0.1 fix работы при закрытом режиме сайта