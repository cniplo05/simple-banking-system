<?php
    use routes\Route;
    use http\PagesController;
    
    Route::set('exam',function(){
            PagesController::CreateView('exam');
    });
    Route::set('login',function(){
        PagesController::login();
    });
    Route::set('logout',function(){
        PagesController::logout();
    });
    Route::set('signup',function(){
        PagesController::signup();
    });
    Route::set('get-user',function(){
        PagesController::getUserInfo();
    });
    Route::set('withdraw',function(){
        PagesController::userWithdraw();
    });
    Route::set('deposit',function(){
        PagesController::userDeposit();
    });
?>