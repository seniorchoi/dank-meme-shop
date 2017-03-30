<h1>Checkout</h1>

<?php if(!empty($messages)) : ?>

    <div id="messages">
    <?php foreach($messages as $type => $type_message) : ?>
        <?php foreach($type_message as $message) : ?>
            <div class="message <?php echo $type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="step">
    <?php echo $step; ?>
</div>