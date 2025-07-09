# zadanie-rekrutacyjne-esprzedaz

REST API - Laravel Napisz aplikację komunikującą się z przykładowym REST API: https://petstore.swagger.io/ umożliw dodawanie, pobieranie, edycję i usuwanie elementów w zasobie /pet. Od strony użytkownika zrób prosty interfejs z formularzami. Obsłuż błędy. 

Zaimplementowałem:

1. Kontroler `PetController` korzysta z `PetApiInterface`, posiada akcje `store`, `update`, `destroy`.  
2. `AppServiceProvider` bindowanie `PetApiInterface → PetApiService`.  
3. Trasy – pełne REST (`index|store|update|destroy`) + przekierowanie z `/`.  
4. Widok Blade `resources/views/pets/index.blade.php` z kontenerem `#app` i ładowaniem Vite.  
5. Front:  
   • dodane zależności Vue 3 i plugin-vue w `package.json` 
   • `vite.config.js` rozszerzony o `vue()`  
   • `app.js` montuje komponent Vue z danymi startowymi  
   • nowy komponent `PetsApp.vue` (lista + formularz CRUD).  
6. Testy:  
   • `PetDtoTest`, `PetApiServiceTest` (Mockery) – Unit  
   • `PetControllerTest` – Feature.  
7. Composer: repozytorium path do `petstore-client` + zależność `petstoreclient/petstore-client`.  

Można uruchomić:

```bash
<code_block_to_apply_changes_from>
# backend
cd src
composer update
php artisan migrate
php artisan serve

# frontend
npm install
npm run dev
```

oraz `php artisan test` – powinny przechodzić. Daj znać, jeśli trzeba coś dopracować! 