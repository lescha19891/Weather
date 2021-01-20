<?php $result = get_option('ls_wp_weather_data');?>

<header>
    <h1>Прогноз погоды</h1>
</header>
<body>
    <ul style=" font-size: 2em">
        <li> Сегодня:<?=$result['day']?></li>
        <li> Температура:<?=$result['temperature']?> <sup>0</sup> C </li>
        <li> <img src="<?=$result['icon']?>", alt="<?=$result['icon']?>"> </li>
        <li> <?=$result['description']?></li>
    </ul>
 <table style=" font-size: 2em">
    <th>Другие дни</th>
 <tr>
    <td><?=$result['firstDay']['day']?></td>
    <td><img src="<?=$result['firstDay']['icon']?>", alt="<?=$result['icon']?>"></td>
 </tr>
 <tr>
    <td><?=$result['secondDay']['day']?></td>
    <td><img src="<?=$result['secondDay']['icon']?>", alt="<?=$result['icon']?>"></td>
 </tr>
 <tr>
    <td><?=$result['thirdDay']['day']?></td>
    <td><img src="<?=$result['thirdDay']['icon']?>", alt="<?=$result['icon']?>"></td>
 </tr>

    </table>



</body>