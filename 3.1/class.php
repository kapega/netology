<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

class Car
{
    const CATEGORY = 'Cars';
    public $name;
    private $price;
    public $color = 'white';
    private $discount;
    
	public function __construct($name, $price, $color, $discount)
    {
        $this->name = $name;
        $this->price = $price;
        $this->color = $color;
        $this->discount = $discount;
    }

    public function showCategory()
    {
        echo self::CATEGORY;
    }

    public function getPrice()
    {
        if ($this->discount) {
            return round($this->price - ($this->price * $this->discount / 100));
        }
        else {
            return ($this->price);
        }
    }
}

class TV

{
    const CATEGORY = 'TVs';
    public $name;
    private $price;
    public $color = 'black';
    private $discount;
	
    public function __construct($name, $price, $color, $discount)
    {
        $this->name = $name;
        $this->price = $price;
        $this->color = $color;
        $this->discount = $discount;
    }

    public function showCategory()
    {
        echo self::CATEGORY;
    }

    public function getPrice()
    {
        if ($this->discount) {
            return round($this->price - ($this->price * $this->discount / 100));
        }
        else {
            return ($this->price);
        }
    }
}

class Pen

{
    const CATEGORY = 'Pens';
    public $name;
    private $price;
    public $color = 'blue';
    public $discount;
	
    public function __construct($name, $price, $color, $discount)
    {
        $this->name = $name;
        $this->price = $price;
        $this->color = $color;
        $this->discount = $discount;
    }

    public function showCategory()
    {
        echo self::CATEGORY;
    }

    public function getPrice()
    {
        if ($this->discount) {
            return round($this->price - ($this->price * $this->discount / 100));
        }
        else {
            return ($this->price);
        }
    }
}

class Duck

{
    const CATEGORY = 'Ducks';
    public $name;
    private $price;
    public $color = 'white';
    private $discount;
	
    public function __construct($name, $price, $color, $discount)
    {
        $this->name = $name;
        $this->price = $price;
        $this->color = $color;
        $this->discount = $discount;
    }

    public function showCategory()
    {
        echo self::CATEGORY;
    }

    public function getPrice()
    {
        if ($this->discount) {
            return round($this->price - ($this->price * $this->discount / 100));
        }
        else {
            return ($this->price);
        }
    }
}

class Product

{
    const CATEGORY = 'Products';
    public $name;
    private $price;
    public $color = 'white';
    private $discount;
	
    public function __construct($name, $price, $color, $discount)
    {
        $this->name = $name;
        $this->price = $price;
        $this->color = $color;
        $this->discount = $discount;
    }

    public function showCategory()
    {
        echo self::CATEGORY;
    }

    public function getPrice()
    {
        if ($this->discount) {
            return round($this->price - ($this->price * $this->discount / 100));
        }
        else {
            return ($this->price);
        }
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="link/favicon.ico">
        <title>Classes</title>
        <link href="link/css/bootstrap.min.css" rel="stylesheet">
        <link href="link/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="theme.css" rel="stylesheet">
        <script src="link/js/ie-emulation-modes-warning.js"></script>
        <style>
            body {
            background: -webkit-linear-gradient(left, #a0ffd7, #baf9ff);
            background: linear-gradient(to right, #a0ffd7, #baf9ff);
            font-family: 'Roboto', sans-serif;
            }
        </style>
    </head>
<body class="vsc-initialized">
    <div style="text-align:center" class="container">
		<div>
		    <h1><?php echo Car::CATEGORY; ?></h1>
<?php
$audi = new Car('Audi Q5', 2980000, 'red', 10);
$renault = new Car('Renault Logan', 500000, 'blue', 0); 
?>
			<p>Today you can buy <?php echo $audi->color . ' ' . $audi->name; ?> for only <?php echo $audi->getprice(); ?> roubles.</p>
			<p>Also <?php echo $renault->color . ' ' . $renault->name; ?> is available for <?php echo $renault->getprice(); ?> roubles.</p>
		</div>

		<div>
			<h1><?php echo TV::CATEGORY; ?></h1>
<?php 
$lg = new TV('LG OLED', 100000, 'black', 13);
$samsung = new TV('Samsung SMART', 120000, 'black', 21); ?>
			<ul style="list-style-type:none">Today we have discounts on the following models:
				<li><?php echo $lg->name; ?> is on sale for <?php echo $lg->getprice(); ?> roubles.</li>
				<li><?php echo $samsung->name; ?> costs <?php echo $samsung->getprice(); ?> roubles.</li>
			</ul>
		</div>

		<div>
			<h1><?php echo Pen::CATEGORY; ?></h1>
<?php
$brunoVisconti = new Pen('Bruno Visconti', 100, 'black', 55);
$erichKrause = new Pen('Erich Krause', 90, 'red', 4); 
?>
			<p>Long awaited sale is starting tomorow!</p>
			<p>Awesome <?php echo $brunoVisconti->color . ' ' . $brunoVisconti->name; ?> with a discount <?php echo $brunoVisconti->discount; ?>%.</p>
			<p>Your favorite <?php echo $erichKrause->color . ' ' . $erichKrause->name; ?> with a discount <?php echo $erichKrause->discount; ?>%.</p>
		</div>

		<div>
			<h1><?php echo Duck::CATEGORY; ?></h1>
<?php
$pekin = new Duck('Pekin', 3000, 'white', 5);
$сayuga = new Duck('Сayuga', 4000, 'green', 4); 
?>
			<p>Start breeding ducks today!</p>
			<p>Wonderful <?php echo $pekin->color . ' ' . $pekin->name; ?> duck with a discount for <?php echo $pekin->getprice(); ?> roubles.</p>
			<p>Cute <?php echo $сayuga->color . ' ' . $сayuga->name; ?> for only <?php echo $сayuga->getprice(); ?> roubles.</p>
		</div>

		<div>
			<h1><?php echo Product::CATEGORY; ?></h1>
<?php
$tea = new Product('Lipton', 100, 'black', 55);
$coffee = new Product('Nescafe', 150, 'green', 4); 
?>
		<p>For tea and coffee lovers!</p>
			<p>Tea <?php echo $tea->color . ' ' . $tea->name; ?> for <?php echo $tea->getprice(); ?> roubles.</p>
			<p>Coffee <?php echo $coffee->color . ' ' . $coffee->name; ?> for <?php echo $coffee->getprice(); ?> roubles.</p>
		</div>
	</div>
</body>
</html>