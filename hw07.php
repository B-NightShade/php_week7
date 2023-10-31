<html>
    <?php
    $attempts = $_POST["att"] ?? 0;
    $posibleWords = array("cabin", "label", "stride", "pride", "march", "walk", "archaic");
    $goal = $_POST["goal"] ?? $posibleWords[array_rand($posibleWords)];
    #echo $goal;
    $hideAnswer = $_POST["hideAnswer"] ?? str_repeat("*", strlen($goal));
    $charGuessed = $_POST["charGuessed"] ?? "";
    $missedChars = $_POST["missedChars"] ?? "";

    
    $found = false;
    for($index = 0; $index < strlen($goal); $index++){
        if ($goal[$index] == $charGuessed){
            $hideAnswer[$index]=$charGuessed;
            $found = true;
        }
    }
    if(!$found and $charGuessed != ""){
        $attempts += 1;
        $missedChars .= $charGuessed .= ", ";
    }
   
    $title="Let's play Hangman";
    $content = "Attempts: " . $attempts . " of 3";
    $content2 = "Misses: " . $missedChars;

    $star = strpos($hideAnswer, "*");

    if($star === false){
        $title = "Winner";
        $hideAnswer = "";
        $content = "You guessed the correct word: '" . $goal . "'";
        $content2 = "";
        $hide = true;
    }
    if($attempts === 3){
        $title = "GAMEOVER";
        $hideAnswer = "";
        $content = "the correct word was '" . $goal . "'";
        $content2 = "";
        $hide = true;
    }
    ?>
    <h1><?php echo $title; ?></h1>
    <p><?php echo $hideAnswer ?></p>
    <?php echo $content; ?>
    <br>
    <?php echo $content2; ?>
    <br>

    <?php if(!isset($hide)){ ?>
    <form method="POST">
        Enter a Character: <input type ="text" name="charGuessed" pattern="[A-Za-z]{1}">
        <br>
        <input type="hidden" name="att" value=<?php echo $attempts; ?>>
        <input type="hidden" name ="goal" value=<?php echo $goal; ?>>
        <input type="hidden" name ="hideAnswer" value=<?php echo $hideAnswer; ?>>
        <input type="hidden" name ="missedChars" value=<?php echo $missedChars; ?>>
        <input type="submit" value="Guess!">
    </form>
    <?php } ?>
</html>