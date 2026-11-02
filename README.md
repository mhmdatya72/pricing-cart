# Pricing Cart

A Laravel 10 app that lists products and generates an invoice with the full price breakdown: **subtotal, shipping, VAT and discounts**.

## Features

- Product listing page
- Invoice generation from the selected products
- Automatic calculation of subtotal, shipping fees, VAT and discounts
- Clean invoice view built with Blade

## Tech Stack

PHP · Laravel 10 · Blade

## Getting Started

```bash
git clone https://github.com/mhmdatya72/pricing-cart.git
cd pricing-cart
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Open `http://127.0.0.1:8000` for the products and `/invoice` for the generated invoice.

## Author

**Mohamed Atya Hawash** — Senior Full-Stack Laravel Developer
[Portfolio](https://mohamedatya-dev.vercel.app) · [LinkedIn](https://www.linkedin.com/in/mohamedatya-dev/)
