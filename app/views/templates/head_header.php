<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?=getenv("path_to_public")?>/assets/css/index.css">

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