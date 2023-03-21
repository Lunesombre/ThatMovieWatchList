<?php
$title="Films";
session_start();
require_once __DIR__ . '/layout/header.php';
?>

<div id="background" class="container p-5">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit voluptates libero deserunt molestiae dolorum incidunt iure, architecto rem inventore blanditiis nostrum expedita reiciendis error! Doloremque facilis doloribus aspernatur omnis quasi?
    Repellendus voluptatem nihil enim ipsam omnis, magnam obcaecati, maxime velit, eligendi at perferendis ullam eos quis ea consequatur impedit qui ipsa expedita. Nostrum voluptas officia maxime et perferendis veritatis ducimus?
    Omnis earum saepe illo eius, voluptates animi dolores est, harum eveniet illum non, magnam quae ex rerum odit. Blanditiis quidem quas omnis ratione amet excepturi sapiente, harum voluptas nam ipsam.
    Dolorem sapiente modi reiciendis cum repellat numquam hic, ex labore quaerat consequatur dicta ullam exercitationem nihil amet esse voluptatum asperiores nostrum nulla eveniet totam odit dolor, ducimus harum excepturi! Qui.
    Quam voluptatum, totam qui tempore perferendis fuga mollitia possimus est. In odit cum quo, aliquid eum dolores deserunt nemo similique quod quaerat dolore blanditiis velit quisquam fugit voluptate, molestias dolorem!
    
    <div class="d-flex movie_card border border-4 border-warning border-opacity-75 rounded-4 bg-light-subtle p-5">
        <div class="col-6">
            <h2>Le Royaume de Naya</h2>
            <h6>Mavka</h6>
            <div class="inline_block">2023</div>
            <div>
                <p>Par dela les hautes Montagnes noires... Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur eligendi pariatur temporibus officia repellat animi, atque necessitatibus, eius iste sed fugit excepturi fuga. Quisquam eligendi dicta, numquam libero voluptatibus omnis.    </p>
            </div>
        </div>
        <div class="poster col-6">
            <img src="./assets/img/naya.png" alt="Affiche_royaume_Naya">
        </div>
    </div>
</div>

<div id="underConstruction"></div>



<?php
require_once __DIR__. '/layout/footer.php';