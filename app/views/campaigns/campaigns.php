<?php
    $total_pages = ceil($data[1] / 9);
    $campaigns = $data[0];
    $page = 1;
    if(isset($_GET["pg"]) && !empty($_GET["pg"])){
        $page = $_GET["pg"];
        
    }
    $start_page = ($page - 1 <= 0) ? 1 : $page - 1;
    $stop_page = ($page + 1 > $total_pages) ? $page : (($page + 2 >= $total_pages) ? $page + 1 : $page + 2);
    
    
    $query = [];
    $search = "";
    if($data[2]) {
        $query['k'] = $_GET['k'];
        $search = "/search";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo getenv("path_to_public");?>/assets/css/campaigns.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        function myFunction() {
            var x = document.getElementById("mobile-navbar");
            if (x.className === "responsive-navbar") {
                x.className = "";
            } else {
                x.className += "responsive-navbar";
            }
        }
    </script>
    
    <title>GASM</title>
</head>

<body>
	<?php include('../app/views/templates/header.php'); ?>	
	
    <main>
        <div id="intro">
            <div>
                <p>Campaigns</p>
            </div>
        </div>
        <div class="campaigns">
            <div class="campaigns__search">
              <form id="campaign-search" action="<?=getenv('path_to_public')?>/campaigns/search" class="campaigns__search__bar search-bar" method="GET">
                <label>
                  <span><img src="<?php echo getenv("path_to_public");?>/assets/images/search.svg" alt="search_icon"></span>
                  <input type="search" name="k" class="search-bar__input">
                </label>
                <button class="btn btn-green" type="submit">Search</button>
              </form>
            </div>
            <?php if($data[2]) {?>
                    <p>Found <?=$data[1]?> results for your search.</p>
                <?php } ?>
            <div class="campaigns__headers">
                
                <?php
					foreach($campaigns as $campaign){?>
					<div class="campaigns__headers__head">
						<img src="<?php echo getenv("path_to_public") . '/assets/images/uploads/' . $campaign['image_name'] ?>" alt="<?= $campaign['title'] ?>">
						<a href="<?=getenv("path_to_public")?>/campaigns/id/<?= $campaign['id'] ?>">
						<p class="campaigns__headers__head__title">
							<?= $campaign['title'] ?>
						</p>
						</a>
					</div>
				<?php } ?>
            </div>
            
            <div class="campaigns__pagination">
                <a class="<?php if($page <= 1){ echo "disabled"; }?>" href="<?php $query['pg'] = $page - 1; echo getenv('path_to_public') . "/campaigns$search" . "?" . http_build_query($query) ?>"><</a>
                <?php for($i = $start_page; $i <= $stop_page; $i++) {?>
                    <a class="<?=($page == $i) ? "page-active" : ''?>" href="<?php $query['pg'] = $i; echo getenv('path_to_public') . "/campaigns$search" . "?" . http_build_query($query) ?>"> <?=$i?> </a>
                    
                <?php } ?>
                <a class="<?php if($page >= $total_pages){ echo "disabled"; }?>" href="<?php $query['pg'] = $page + 1; echo getenv('path_to_public') . "/campaigns$search" . "?" . http_build_query($query) ?>">></a>
            </div>
        </div>
    </main>

	<?php include('../app/views/templates/footer.php'); ?>
</body>

</html>