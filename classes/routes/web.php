<?php
    use routes\Route;
    use http\PagesController;
    
    Route::set('exam',function(){
            PagesController::CreateView('exam');
    });
?>