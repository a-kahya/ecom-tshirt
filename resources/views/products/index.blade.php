
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $category->name }} - Ecom T-Shirt</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f8f8f8;
            color: #222;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 24px;
        }

        .back-link {
            color: #555;
            text-decoration: none;
        }

        h1 {
            margin-top: 30px;
            font-size: 32px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(
                auto-fill,
                minmax(230px, 1fr)
            );
            gap: 24px;
            margin-top: 35px;
        }

        .product-card {
            position: relative;
            display: block;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            transition: transform .2s;
        }

        .product-card:hover,
        .product-card:focus-visible {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            display: block;
        }

        .tooltip {
            position: absolute;
            bottom: 12px;
            left: 50%;
            transform: translateX(-50%);
            background: #222;
            color: white;
            padding: 9px 14px;
            border-radius: 5px;
            font-size: 14px;
            opacity: 0;
            transition: opacity .2s;
            pointer-events: none;
            white-space: nowrap;
            max-width: 95%;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-card:hover .tooltip,
        .product-card:focus-visible .tooltip {
            opacity: 1;
        }

        .empty {
            margin-top: 40px;
            padding: 40px;
            text-align: center;
            background: white;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<main class="container">

    <a href="{{ url('/') }}" class="back-link">
        ← Retour aux catégories
    </a>

    <h1>{{ $category->name }}</h1>

    <p>
        {{ $products->count() }}
        produit(s) disponible(s)
    </p>

    @if($products->isEmpty())

        <div class="empty">
            <h2>Aucun produit disponible</h2>
            <p>
                Aucun produit n'est actuellement
                associé à cette catégorie.
            </p>
        </div>

    @else

        <div class="product-grid">

            @foreach($products as $product)

                <a
                    href="{{ url('/products/' . $product->id) }}"
                    class="product-card"
                    title="{{ $product->name }}"
                    aria-label="Voir les détails de {{ $product->name }}"
                >

                    <img
                        src="{{ $product->image
                            ? asset('storage/' . $product->image)
                            : asset('images/placeholder.png') }}"
                        alt="{{ $product->name }}"
                        loading="lazy"
                    >

                    <span class="tooltip">
                        {{ $product->name }}
                    </span>

                </a>

            @endforeach

        </div>

    @endif

</main>

</body>
</html>
