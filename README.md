# sistema-shortlink
Sistema de encurtador de URL feito com Laravel, Vue.js, Tailwindcss

#Configuração do Ambiente e Instalação

## Crie um novo projeto Laravel
```bash
  
composer create-project --prefer-dist laravel/laravel shortlink-app
```

## Acesse o diretório do projeto
```bash 
cd shortlink-app
```

 ## Instale o Vue.js
```bash
composer require laravel/ui
php artisan ui vue --auth
npm install
npm run dev
```

## Instale o Tailwind CSS
```bash 
npm install tailwindcss
npx tailwindcss init
```

#Configuração do Banco de Dados
```bash 
php artisan migrate
```

#Desenvolvimento da Aplicação

##Crie um modelo para os shortlinks
```bash 
php artisan make:model Shortlink -m
```

#Iniciar o projeto
```bash 
php artisan start
```

#Acessar o projeto
```bash 
http://localhost:8000/shortlinks
```
