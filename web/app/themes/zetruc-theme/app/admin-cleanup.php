<?php

/**
 * Nettoyage et optimisation de l'interface d'administration WordPress */

namespace App\Admin;

/**
 * PERSONNALISATION DE LA PAGE DE CONNEXION
 */

// Changer le logo de la page de connexion
add_action('login_head', function () {
    ?>
    <style>
        .login h1 a {
            background-image: none;
            text-indent: 0;
            width: auto;
            height: auto;
            font-size: 24px;
            font-weight: bold;
            color: #333;}
        /* } */
    </style>
    <?php
});

// Changer le lien du logo vers votre site
add_filter('login_headerurl', function () {
    return home_url();
});

// Changer le titre du logo
add_filter('login_headertext', function () {
    return get_bloginfo('name');
});

/**
 * AJOUT D'UN WIDGET PERSONNALISÉ AU TABLEAU DE BORD
 * Informations utiles pour l'équipe
 */

add_action('wp_dashboard_setup', function () {
    wp_add_dashboard_widget(
        'agency_info_widget',
        'Informations du site',
        function () {
            ?>
            <div style="padding: 10px;">
                <h4>Informations importantes</h4>
                <p><strong>Site :</strong> <?php echo get_bloginfo('name'); ?></p>
                <p><strong>URL :</strong> <?php echo home_url(); ?></p>
                <p><strong>Version WordPress :</strong> <?php echo get_bloginfo('version'); ?></p>
                
                <h4>Actions rapides</h4>
                <p>
                    <a href="<?php echo admin_url('options-general.php'); ?>" class="button">Réglages généraux</a>
                    <a href="<?php echo admin_url('nav-menus.php'); ?>" class="button">Menus</a>
                    <a href="<?php echo admin_url('post.php?post_type=global'); ?>" class="button">Paramètres globaux</a>
                </p>
            </div>
            <?php
        }
    );
});

