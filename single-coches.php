<?php get_header(); ?>

<?php
// Declaración de variables
$marca = get_field('acf_coches_marca');
$combustible = get_field('acf_coches_combustible');
$tipo_coche = get_field('acf_coches_tipo_de_coche');
$modelo = get_field('acf_coches_modelo');
$ano_modelo = get_field('acf_coches_ano');
$tipo_cambio = get_field('acf_coches_tipo_de_cambio');
$caballos = get_field('acf_coches_caballos');
$consumo_carretera = get_field('acf_coches_consumo_medio_carretera');
$consumo_urbano = get_field('acf_coches_consumo_medio_urbano');
$pvp = get_field('acf_coches_pvp');
$ficha_tecnica = get_field('acf_coche_ficha_tecnica');
// Declaración de variables
?>

<section class="uk-container uk-container-center uk-margin-large-top uk-margin-large-bottom">

    <div uk-grid class="uk-margin-medium-top">
        <article class="uk-width-2-3@m">

        <h1 class="uk-h1 uk-article-title"><?php the_title(); ?></h1>

        <?php the_post_thumbnail('full'); ?>

        <?php the_excerpt(); ?>

        <?php the_content(); ?>

        <?php the_field('contenido'); ?>

        <?php $images = get_field('acf_coches_galeria_de_imagenes');
        if( $images ): ?>
        <h3>Galería de imágenes</h3>
        <div class="uk-child-width-1-3@m uk-animation-fade" uk-grid uk-lightbox="animation: fade">
            <?php foreach( $images as $image ): ?>
            <a class="uk-inline" href="<?php echo esc_url($image['sizes']['large']); ?>">
                <img data-alt="Image" src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if( have_rows('acf_enlaces_de_interes') ): ?>
            <h3>Recursos adicionales:</h3>
                <ul>
                    <?php while ( have_rows('acf_enlaces_de_interes') ) : the_row(); ?>

                    <?php $link = get_sub_field('enlace_de_interes');
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <li><a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></li>
                    <?php endif; ?>

                    <?php endwhile; ?>
                </ul>
        <?php endif; ?>
        </article>

        <aside class="uk-width-1-3@m">
            <div uk-sticky="offset: 100">
                <h4>Características técnicas</h4>
                <table class="uk-table uk-table-divider uk-table-striped">
                    <tbody>
                        <tr>
                            <td class="uk-text-right"><strong>Marca</strong></td>
                            <td><a href="<?php echo esc_url( get_term_link( $marca ) ); ?>"><?php echo $marca->name; ?></a></td>
                        </tr>
                        <tr>
                            <td class="uk-text-right"><strong>Combustible</strong></td>
                            <td><a href="<?php echo esc_url( get_term_link( $combustible ) ); ?>"><?php echo $combustible->name; ?></a></td>
                        </tr>
                        <tr>
                            <td class="uk-text-right"><strong>Tipo de coche</strong></td>
                            <td><?php echo $tipo_coche; ?></td>
                        </tr>
                        <tr>
                            <td class="uk-text-right"><strong>Modelo</strong></td>
                            <td><?php echo $modelo; ?></td>
                        </tr>
                        <tr>
                            <td class="uk-text-right"><strong>Año del modelo</strong></td>
                            <td><?php echo $ano_modelo; ?></td>
                        </tr>
                        <tr>
                            <td class="uk-text-right"><strong>Tipo de cambio</strong></td>
                            <td><?php echo $tipo_cambio; ?></td>
                        </tr>
                        <tr>
                            <td class="uk-text-right"><strong>Caballos</strong></td>
                            <td><?php echo $caballos; ?> cv</td>
                        </tr>

                        <?php if ($pvp): ?>
                            <tr>
                            <?php setlocale(LC_MONETARY, 'it_IT'); ?>
                                <td class="uk-text-right"><strong>PVP desde</strong></td>
                                <td><?php echo money_format('%.2n', $pvp) . "\n"; ?>€</td>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <td class="uk-text-right"><strong>Consumo carretera</strong></td>
                            <td><?php echo $consumo_carretera; ?></td>
                        </tr>

                        <tr>
                            <td class="uk-text-right"><strong>Consumo urbano</strong></td>
                            <td><?php echo $consumo_urbano; ?></td>
                        </tr>

                    </tbody>

                </table>

                <?php if ($ficha_tecnica): ?>
                <div class="uk-text-center">
                    <a class="uk-button uk-button-primary" href="<?php echo $ficha_tecnica; ?>" target="_blank"><i class="uk-icon uk-icon-download uk-margin-small-right"></i>Descarga ficha técnica</a>
                </div>
                <?php endif; ?>
            </div>
        </aside>

    
</section>

<?php get_footer(); ?>