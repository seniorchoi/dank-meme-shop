<table>
    <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                Price per unit
            </th>
            <th>
                Amount
            </th>
            <th>
                Total price
            </th>
        </tr>
    </thead>
    <tbody>
    <?php $total = 0; ?>
    <?php foreach($products as $product) : ?>
        <tr>
            <td>
                <?php echo $product['name']; ?>
            </td>
            <td>
                <?php echo $product['price']; ?> sweg
            </td>
            <td>
                
                <form action="" method="post">
                    <input type="text" value="<?php echo  number_format($amounts[ $product['id'] ], 0, ',', ' '); ?>" name="amount" />
                    <input type="hidden" value="<?php echo $product['id']; ?>" name="product_id" />
                    <input type="submit" value="->" name="change_amount" onclick="if(!confirm('Do you really want to change the amount?')) return false;" />
                </form>
            </td>
            <td>
                <?php echo  number_format($amounts[ $product['id'] ] * $product['price'], 0, ',', ' '); ?> sweg
                <?php $total += $amounts[ $product['id'] ] * $product['price']; ?>
            </td>
            <td>
                <form action="" method="post">
                    <input type="hidden" value="<?php echo $product['id']; ?>" name="product_id" />
                    <input type="submit" value="X" name="clear_item" onclick="if(!confirm('Do you really want to remove the item?')) return false;"/>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <th colspan="3">
                TOTAL:
            </th>
            <td>
                <?php echo number_format($total, 0, ',', ' '); ?> sweg
            </td>
        </tr>
    </tbody>
</table>