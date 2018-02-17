<table border="1">
    <tr>
        <th>id</th>
        <th>q</th>
        <th>sq</th>
    </tr>
    <?php foreach($GLOBALS['asdf'] as $asdf): ?>
    <tr>
        <td><?php echo $asdf->id; ?></td>
        <td><?php echo $asdf->q; ?></td>
        <td><?php echo $asdf->sq; ?></td>
    </tr>
    <?php endforeach ?>
</table>