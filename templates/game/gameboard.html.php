<h1>Spielbrett</h1>
<table>
    <?php for($i = 1; $i <= 3; $i++): ?>
        <tr>
            <?php for($k = 1; $k <= 3; $k++): ?>
                <td><?= "$i $k" ?></td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>

