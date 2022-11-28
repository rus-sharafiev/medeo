<?php session_start(); ?>

<?php include 'login.php';

$id = $_POST['id'] ?? NULL;
$dir = $_POST['dir'] ?? NULL;
$cat = $_POST['cat'] ?? NULL;
$subcat = $_POST['subcat'] ?? NULL;
$name = $_POST['name'] ?? NULL;
$q = $_POST['q'] ?? NULL;

if ($dir != NULL && $subcat != NULL && $cat != NULL) {
    $query = "SELECT * FROM catalog WHERE direction = '$dir' AND category = '$cat' AND subcategory = '$subcat'";
} else if ($dir != NULL && $cat != NULL) {
    $query = "SELECT * FROM catalog WHERE direction = '$dir' AND category = '$cat'";
} else if ($id != NULL) {
    $query = "SELECT * FROM catalog WHERE id = '$id'";
} else if ($dir != NULL) {
    $query = "SELECT * FROM catalog WHERE direction = '$dir'";
} else if ($cat != NULL) {
    $query = "SELECT * FROM catalog WHERE category = '$cat'";
} else if ($subcat != NULL) {
    $query = "SELECT * FROM catalog WHERE subcategory = '$subcat'";
} else if ($name != NULL) {
    $query = "SELECT * FROM catalog WHERE name = '$name'";
} else {
    $query = "SELECT * FROM catalog WHERE
    direction LIKE '%$q%' OR 
    category LIKE '%$q%' OR 
    subcategory LIKE '%$q%' OR 
    name LIKE '%$q%' OR 
    id LIKE '$q%'";
}

if ($stmt = $mysqli->prepare($query)) {
    $stmt->execute();
    $stmt->store_result();
	$stmt->bind_result(
		$id,
        $direction,
        $category,
        $subcategory,
        $name,
        $name_add,
        $dia,
        $lenth,
        $add,
        $img,
        $handle);
}

// Nothing is found
if ($stmt->num_rows == 0) {
	?>
	<div class='nothing-found'>
        <span class="icon">search_off</span>
        Ничего не найдено, измените условия поиска
    </div> <?php

// Single item
} else if ($stmt->num_rows == 1) {
	$stmt->fetch(); ?>

    <div class="item">
        <div class='item-image'>
            <div><img src="<?php echo $img ?>" alt="Pic"></div> <?php
            if ($handle != NULL) { ?>
                <div><img src="<?php echo $handle ?>" alt="Pic"></div> <?php
            } ?>
        </div>
        <div class="item-name">
            <div class='item-name-top'>
                <div class="item-n">
                    <?php printf ($name); ?><?php
                    if ($name_add != NULL) { ?>
                        <span><?php printf ($name_add); ?></span><?php
                    } ?>
                </div> <?php
                if ($add != NULL) { ?>
                    <div class="item-n-add"><?php printf ($add); ?></div><?php
                }
                if ($dia != NULL || $lenth != NULL) { ?> 
                    <div class="item-n-dia-lenth"><?php
                        if ($dia != NULL) { ?>
                            <span>∅</span> <?php printf ($dia); ?><?php
                        }
                        if ($dia != NULL && $lenth != NULL) { ?>, <?php }
                        if ($lenth != NULL) { ?>
                            <span>длина</span> <?php printf ($lenth); ?><?php
                        } ?> 
                    </div><?php
                }?>
            </div>
            <div class="item-name-bottom">
                <?php printf ($direction); ?>
                &emsp;>&emsp;
                <?php printf ($category); ?>
                &emsp;>&emsp;
                <?php printf ($subcategory); ?>
                &emsp;>&emsp;
                <span>арт. </span><?php printf ($id); ?>
            </div>
        </div>
        <div class='s-bttn' onClick="shareLink('<?php printf ($name); ?>', '<?php printf ($id); ?>')">
            Поделиться ссылкой
            <span class='icon'>ios_share</span>
        </div>
        <a class='send-question' href='https://wa.me/79625590765?text=<?php echo urlencode('Уточните, пожалуйста, наличие и цену https://medeo.srrlab.ru/#' . $id); ?>' target="_blank" rel="noopener"> Уточнить наличие и цену
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 31 30">
                <path d="
                    M15.565 0C7.057 0 .133 6.669.13 14.865c-.002 2.621.71 5.179 2.06 7.432L0 30l8.183-2.067a15.89 15.89 0 007.376 1.81h.006c8.508 0 
                    15.432-6.67 15.435-14.866.002-3.97-1.602-7.707-4.517-10.516C23.569 1.551 19.694.001 15.565 0zm0 27.232h-.005c-2.302 
                    0-4.56-.596-6.53-1.722l-.47-.268-4.854 1.226 1.296-4.56-.305-.467a11.983 11.983 0 01-1.962-6.576C2.738 8.052 8.494 2.511 
                    15.57 2.511c3.426.001 6.647 1.288 9.07 3.623s3.756 5.44 3.754 8.742c-.003 6.813-5.758 12.356-12.83 
                    12.356zm7.037-9.255c-.386-.185-2.282-1.084-2.636-1.209-.353-.123-.61-.187-.867.185-.256.372-.996 1.209-1.22 
                    1.456-.226.248-.451.278-.837.093-.386-.186-1.629-.578-3.101-1.844-1.147-.984-1.921-2.2-2.146-2.573-.225-.371-.024-.572.169-.757.173-.165.386-.433.578-.65.192-.217.256-.372.386-.62.128-.247.064-.465-.033-.65-.097-.187-.867-2.015-1.19-2.758-.312-.724-.63-.627-.867-.639-.225-.01-.481-.013-.74-.013-.255 
                    0-.674.093-1.028.465-.353.372-1.35 1.27-1.35 3.098 0 1.829 1.382 3.595 1.575 3.843.193.247 2.72 4 6.589 5.61.92.381 
                    1.638.61 2.199.782.924.283 1.765.242 2.429.147.74-.107 2.282-.898 2.602-1.765.322-.867.322-1.611.226-1.766-.094-.155-.352-.248-.738-.435z">
                </path>
            </svg>
        </a>
    </div>

    <?php

// Multiple items
} else {
	$subcategory_array = array();
	$category_array = array();
	if ($searchresult = $mysqli->query($query)) {
		while ($row = $searchresult->fetch_assoc()) {
			if (!in_array(array($row["category"], $row["subcategory"], $row["direction"]), $subcategory_array)) {
				$subcategory_array[] = array($row["category"], $row["subcategory"], $row["direction"]);
                if (!in_array(array($row["category"], $row["direction"]), $category_array)) {
                    $category_array[] = array($row["category"], $row["direction"]);
                }
			} 	
		}
		$searchresult->free();
	} 

    foreach ($category_array as $carr) { ?>
    <div class="category">
        <div class="category-title no-select"><?php printf ($carr[0]); ?><span>(<?php printf ($carr[1]); ?>)</span></div> <?php

        foreach ($subcategory_array as $sarr) { 
            if ($sarr[0] == $carr[0]) { ?>
            <div class="subcategory">
                <div class="subcategory-title no-select"><?php printf ($sarr[1]); ?></div> <?php

                $stmt->data_seek(0);
                while ($stmt->fetch()) {
                    if ($subcategory == $sarr[1] && $category == $sarr[0]) { ?>
                        <div class="card" onclick="itemPage('<?php printf ($category); ?>','<?php printf ($subcategory); ?>','<?php printf ($id); ?>')">
                            <div class='card-image'>
                                    <img src="<?php echo $img ?>" alt="Pic">
                            </div>
                            <div class="card-name">
                                <div class="card-n">
                                    <div><?php printf ($name); ?></div>
                                    <div></div>
                                </div><?php
                                if ($name_add != NULL) { ?>
                                    <div class="card-n-nadd"><?php printf ($name_add); ?></div><?php
                                }
                                if ($add != NULL) { ?>
                                    <div class="card-n-add"><?php printf ($add); ?></div><?php
                                }
                                if ($dia != NULL || $lenth != NULL) { ?> <div class="card-n-dia-lenth"><?php
                                    if ($dia != NULL) { ?>
                                        <span>∅</span> <?php printf ($dia); ?><?php
                                    }
                                    if ($dia != NULL && $lenth != NULL) { ?>, <?php }
                                    if ($lenth != NULL) { ?>
                                        <span>длинна</span> <?php printf ($lenth); ?><?php
                                    } ?> </div><?php
                                }?> 
                            </div>	
                            <div class="card-id">Арт. <?php printf ($id); ?></div>			
                        </div> <?php
                    }
                } ?>

            </div><?php
            }
        } ?>

    </div><?php
    }
}

$stmt->close();
$mysqli->close();
?>

<script>
    $('main').removeClass();
    function itemPage(c, s, i) {
        $('main').html("<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>");
        $('main').load( 'search.php', { id: i });
        $('.active').removeClass('active');
        history.pushState({ id: i }, "", "/#" + i);
    }

    // Share
    async function shareLink(name, id) {
        navigator.share({
            title: name + ' - арт. ' + id,
            text: name + ' - арт. ' + id,
            url: decodeURI(window.location),
        });
    };
</script>