<?php

require_once "db.php";

$search = trim($_GET['search'] ?? '');

if ($search !== '') {

    $stmt = $pdo->prepare("
        SELECT *
        FROM poems
        WHERE title LIKE :search
           OR author LIKE :search
           OR content LIKE :search
        ORDER BY created_at ASC
    ");

    $stmt->execute([
        'search' => '%' . $search . '%'
    ]);

} else {

    $stmt = $pdo->query("
        SELECT *
        FROM poems
        ORDER BY created_at ASC
    ");

}

$poems = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="sq">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Arkivi i Poezisë</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>


<!-- FOTOJA -->

<section class="opening-image">

    <img
        src="images/beth.webp"
        alt="Beth"
    >

</section>



<!-- TITLE -->

<section class="intro">

    <div class="intro-inner">

        <p class="small-title">
            ARKIVI I POEZISË
        </p>


        <div class="intro-line"></div>

        <p class="description">
            Një koleksion poezish, e cila pikon melankoli dhe pasion.
        </p>

    </div>

</section>



<!-- SEARCH -->

<section class="search-area">

    <form method="GET" action="index.php">

        <input
            type="text"
            name="search"
            placeholder="Kërko në arkiv..."
            value="<?= htmlspecialchars($search) ?>"
        >

        <button type="submit">
            →
        </button>

    </form>

    <?php if ($search !== ''): ?>

        <p class="search-info">
            Rezultatet për
            <strong><?= htmlspecialchars($search) ?></strong>
            — <?= count($poems) ?> poezi
        </p>

    <?php endif; ?>

</section>



<!-- POEMS -->

<main class="poetry-archive">


<?php if (!empty($poems)): ?>


    <?php foreach ($poems as $index => $poem): ?>


        <article class="poem">

            <div class="poem-index">

                <?= str_pad(
                    $index + 1,
                    2,
                    '0',
                    STR_PAD_LEFT
                ) ?>

            </div>


            <div class="poem-main">


                <div class="poem-heading">

                    <p class="poem-author">

                        <?= htmlspecialchars(
                            $poem['author']
                        ) ?>

                    </p>


                    <h2>

                        <?= htmlspecialchars(
                            $poem['title']
                        ) ?>

                    </h2>

                </div>



                <div class="poem-text">

                    <?= nl2br(
                        htmlspecialchars(
                            $poem['content']
                        )
                    ) ?>

                </div>



            </div>

        </article>


    <?php endforeach; ?>


<?php else: ?>


    <section class="empty">

        <h2>
            Arkivi është bosh.
        </h2>

        <p>
            Nuk ka ende poezi të regjistruara.
        </p>

    </section>


<?php endif; ?>


</main>



<div class="elfsight-app-76bd8a50-fa9f-4e99-9683-9d8e9d6fde89" data-elfsight-app-lazy></div>
<footer>

    <p>
        ARKIVI I POEZISË
    </p>

    <span>
        © <?= date('Y') ?>
    </span>

</footer>


</body>
<!-- Elfsight Background Music | Untitled Background Music -->
<script src="https://elfsightcdn.com/platform.js" async></script>
</html>