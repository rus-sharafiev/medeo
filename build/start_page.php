<?php session_start(); ?>

<?php

include 'login.php';

$query = "SELECT direction, category, subcategory, img FROM catalog";

$subcat_array = array();
$cat_array = array();
$direction_array = array();
$img_array = array();

if ($searchresult = $mysqli->query($query)) {
	while ($row = $searchresult->fetch_assoc()) {

		if (!in_array(array($row["direction"], $row["category"], $row["subcategory"]), $subcat_array)) {
			$subcat_array[] = array($row["direction"], $row["category"], $row["subcategory"]);

            if (!in_array(array($row["direction"], $row["category"], $row["subcategory"], $row["img"]), $img_array)) {
			    $img_array[] = array($row["direction"], $row["category"], $row["subcategory"], $row["img"]);
            }

            if (!in_array(array($row["direction"], $row["category"]), $cat_array)) {
                $cat_array[] = array($row["direction"], $row["category"]); 

                if (!in_array(array($row["direction"]), $direction_array)) {
                    $direction_array[] = array($row["direction"]);
                }
            }
		} 	
	}
	$searchresult->free();
}

foreach ($direction_array as list($direction)) { ?>
    <div> 
        <div class='montserrat no-select'><?php printf ($direction); ?></div><?php
        foreach ($cat_array as list($d, $category)) {
            if ($d == $direction) {
                foreach ($subcat_array as list($d, $c, $subcategory)) {
                    if ($c == $category && $d == $direction) { ?>
                        <div class='<?php printf ($category); ?>'> <?php
                            foreach ($img_array as list($id, $ic, $is, $i)) {
                                if ($id == $direction && $ic == $category && $is == $subcategory) { ?>
                                    <div><img src="<?php echo $i ?>" alt="<?php printf ($subcategory); ?>"></div> <?php 
                                }
                            } ?>
                            <div><?php printf ($subcategory); ?></div>
                        </div> <?php
                    }
                }
            }
        } ?>
    </div> <?php
}

$mysqli->close();
?>

<script>
    $('main').addClass('start');
    $('main > div > div:nth-child(n+2)').click( function() {
        $('.active').removeClass('active');
        $('main').html("<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>");
        var subcat_data = $(this).children().last().text();
        var cat_data = $(this).attr('class');
        var dir_data = $(this).parent().children().first().text();
        console.log(dir_data);
        $('main').load('search.php', { subcat: subcat_data, cat: cat_data, dir: dir_data });
        history.pushState({ subcat: subcat_data, cat: cat_data, dir: dir_data }, "", "/" + cat_data + "_" + subcat_data + "_(" + dir_data + ")");
    });
</script>