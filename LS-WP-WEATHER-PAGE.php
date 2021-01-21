<?php $result = get_weather();?>

<header>
    <h1>Прогноз погоды</h1>
</header>
<body>
    <ul style=" font-size: 2em">
        <li> Сегодня: <?=$result['day']?></li>
        <li> Температура: <?=$result['temperature']?> <sup>0</sup>C </li>
        <li> <img src="<?=$result['icon']?>", alt="<?=$result['icon']?>"> </li>
        <li> <?=$result['description']?></li>
    </ul>
 <table border="1", cellpadding="7" style=" font-size: 2em " >
    <th colspan="2">Другие дни</th>
 <tr>
    <td align="center"><?=$result['firstDay']['day']?></td>
    <td align="center"><img src="<?=$result['firstDay']['icon']?>", alt="<?=$result['icon']?>" height=25></td>
 </tr>
 <tr>
    <td align="center"><?=$result['secondDay']['day']?></td>
    <td align="center"><img src="<?=$result['secondDay']['icon']?>", alt="<?=$result['icon']?>" height=25></td>
 </tr>
 <tr>
    <td align="center"><?=$result['thirdDay']['day']?></td>
    <td align="center"><img src="<?=$result['thirdDay']['icon']?>", alt="<?=$result['icon'] ?>" height=25></td>
 </tr>

    </table>



</body>