# ERP Laravel 🚀

![PHP](https://img.shields.io/badge/PHP-8.4-blue?logo=php) ![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel) ![Database](https://img.shields.io/badge/Database-SQLite-lightgrey) ![License](https://img.shields.io/badge/License-MIT-green)

Sistema ERP completo desenvolvido em **Laravel 12** para gerenciamento de **produtos, fornecedores, clientes, estoque e movimentações**. Ideal para quem quer aprender boas práticas em Laravel ou utilizar como base para projetos empresariais.

---

### 🔹 Funcionalidades

- Dashboard com resumo de informações do sistema.
- **CRUD de clientes, fornecedores e produtos**.
- Controle de **estoque vinculado a produtos**.
- Registro de **movimentações de entrada e saída de produtos**.
- Sistema de autenticação e gerenciamento de administradores.
- Criação automática de usuário administrador ao rodar o projeto pela primeira vez.
- Uso de **Repositórios**, **try/catch** e validação no controller para manter o código limpo e seguro.
- Mensagens de sucesso e erro para melhorar a experiência do usuário.
- Blade Components para tabelas e botões reutilizáveis.

---

### 🔹 Instalação e Setup

1. Clone o repositório:

```bash
git clone https://github.com/SeuUsuario/ERPLaravel.git
cd ERPLaravel
```

2. Instalando dependências:

```bash
composer install
npm install
```


3. Rodar a seed do banco:

```bash
php artisan migrate --seed
```

2. Compilar assets:

```bash
npm run dev
```

2. Iniciar servidor:

```bash
php artisan serve
```

