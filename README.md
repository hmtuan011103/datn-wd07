## Clone về setup

-   Copy file .env.example ra file mới đổi tên thành .env
-   php artisan key:generate
-   php artisan storage:link
-   php artisan migrate
-   composer update
-   php artisan jwt:secret
-   Config database trong file .env
-   Config mail trong file .env (có thể sử dụng [mailtrap](https://mailtrap.io/) hoặc bên nào tùy ý)
-   Done!

## Cách phân quyền route bên admin bởi permission

Các route và quyền hiện đã được config ổn định, nếu bạn muốn tạo route hoặc quyền hay vai trò mới bạn có thể tham khảo bên dưới:

Note: Nếu không tạo mới quyền và vai trò có thể skip B1, B2. 

-   B1: Bạn cần tạo quyền tại "Vai trò & phân quyền > Phân quyền" (Nếu quyền đã tồn tại thì bạn không cần tạo lại nữa, danh sách ở bên dưới)

Note: Tên quyền sẽ được dùng để "kiểm tra quyền" sau này, hãy đặt tên quyền theo cú pháp kebab-case cụ thể action-object

Ví dụ: create-user, read-user, update-user, delete-user, create-user-type . . .

-   B2: Giờ đã có quyền được tạo ở B1 rồi, bạn tạo vai trò tại "Vai trò & phân quyền > Vai trò" với các quyền bạn muốn
-   B3: Khai báo route (bạn khai báo route như bình thường)
-   B4: Phân quyền cho route, bạn chỉ cần thêm middleware "check_permission" cùng các quyền mong muốn là ok

Cú pháp: 

Phân 1 quyền:
     
     middleware('check_permission:permission-01')
 
Phân nhiều quyền:

    middleware('check_permission:permission-01,permission-02,permission-03')

Ví dụ:

     Route::get('create', [UserController::class, 'create'])->middleware('check_permission:create-user')->name('create');
    
     Route::get('create', [UserController::class, 'create'])->middleware('check_permission:create-user,read-user')->name('create'); 


## Danh sách các quyền mặc định:

-    create-permission
-    read-permission
-    update-permission
-    delete-permission
-    create-role
-    read-role
-    update-role
-    delete-role
-    create-role-permission
-    read-role-permission
-    update-role-permission
-    delete-role-permission
-    create-user-role
-    read-user-role
-    update-user-role
-    delete-user-role
-    create-user-type
-    read-user-type
-    update-user-type
-    delete-user-type
-    create-user
-    read-user
-    update-user
-    delete-user
-    create-location
-    read-location
-    update-location
-    delete-location
-    create-car-type
-    read-car-type
-    update-car-type
-    delete-car-type
-    create-car
-    read-car
-    update-car
-    delete-car
-    create-seat
-    read-seat
-    update-seat
-    delete-seat
-    create-trip
-    read-trip
-    update-trip
-    delete-trip
-    create-bill
-    read-bill
-    update-bill
-    delete-bill
-    create-discount-code-type
-    read-discount-code-type
-    update-discount-code-type
-    delete-discount-code-type
-    create-discount-code
-    read-discount-code
-    update-discount-code
-    delete-discount-code
-    create-news
-    read-news
-    update-news
-    delete-news
-    create-comment
-    read-comment
-    update-comment
-    delete-comment
-    create-banner
-    read-banner
-    update-banner
-    delete-banner
