___
# МИНИСТЕРСТВО НАУКИ И ВЫСШЕГО ОБРАЗОВАНИЯ РОССИЙСКОЙ ФЕДЕРАЦИИ ФЕДЕРАЛЬНОЕ ГОСУДАРСТВЕННОЕ БЮДЖЕТНОЕ ОБРАЗОВАТЕЛЬНОЕ УЧРЕЖДЕНИЕ ВЫСШЕГО ПРОФЕСИОНАЛЬНОГО ОБРАЗОВАНИЯ «САХАЛИНСКИЙ ГОСУДАРСТВЕННЫЙ УНИВЕРСИТЕТ»
### ***<center>Лабораторная работа №9. «Разработка серверных скриптов».</center>*** <br><p align="right">Подготовил студент направления подготовки 01.03.02 «Прикладная математика и информатика»<br> Института естественных наук и техносферной безопасности<br> Зураев Дмитрий Бакенович.</p><br><p align="right">Научный руководитель:<br> Соболев Евгений Игоревич</p><br> <center>Южно-Сахалинск 2023 г.</center>
___
### <center>Введение</center>
<p align="justify">PHP (Hypertext Preprocessor) — это сценарный язык программирования, который используется для разработки динамических веб-страниц и веб-приложений. Он был создан с целью интеграции в HTML-код и обработки данных на стороне сервера. PHP является серверным языком, что означает, что код PHP выполняется на веб-сервере, а не в браузере пользователя.</p>

### <center>Цели</center>
<p align="justify"></p>

### <center>Задачи</center>
<p align="justify">Применить технологию PHP.</p>

____________________
## <center>_Решение_</center>
1.	По заходу на страницу выведите сколько дней осталось до нового года
```php
<?php
  $today = date_create();
  $nextYear = date_format($today, "Y") + 1;
  $nyDate = date_create("$nextYear-01-01");
  $dateDiff = date_diff($today, $nyDate);
  echo "Дней до Нового года: $dateDiff->days";
  ?>
```
2.	Дан инпут и кнопка. В этот инпут вводится год. По нажатию на кнопку выведите на экран, високосный он или нет.

```php
<form action="" method="POST">
    <label>Год:</label>
    <input type="text" name="task2">
    <input type="submit" value="submit">
  </form>
  <?php
  if (isset($_POST["task2"])) {
    $year = $_POST["task2"];
    echo "$year - ", date("L", strtotime("$year-01-01")) ? "Високосный" : "Невисокосный";
  }
  ?>
```
3.	Дан инпут и кнопка. В этот инпут вводится дата в формате '01.12.1990'. По нажатию на кнопку выведите на экран день недели, соответствующий этой дате, например, 'воскресенье'.

```php
<form action="" method="post">
    <label>Дата:</label>
    <input type="date" name="task3">
    <input type="submit" value="submit">
  </form>
  <?php
  if (isset($_POST["task3"])) {
    $days = ["понедельник", "вторник", "среда", "четверг", "пятница", "суббота", "воскресенье"];
    $date = strtotime($_POST["task3"]);
    $day = date("N", $date);
    echo $days[$day - 1];
  }
```
4.	По заходу на страницу выведите текущую дату в формате '12 мая 2015 года, воскресенье'.
```php
<?php
  echo date("jS \of F Y\, l");
  ?>
```
5.	Дан инпут и кнопка. В этот инпут вводится дата рождения в формате '01.12.1990'. По нажатию на кнопку выведите на экран сколько дней осталось до дня рождения пользователя.
```php
<form action="" method="post">
    <label>День рождения:</label>
    <input type="date" name="task5">
    <input type="submit" value="submit">
  </form>
  <?php
  if (isset($_POST["task5"])) {
    $date = strtotime($_POST["task5"]);
    $day = date("d", $date);
    $month = date("m", $date);
    $year = date("Y") + 1;
    echo "Дней до дня рождения: " . date_diff(date_create(), date_create("$day-$month-$year"))->days;
  }
```
6.	По заходу на страницу выведите сколько дней осталось до ближайшей масленицы (последнее воскресенье весны).
```php
<?php
  $today = date_create();
  $date = date_create("last Sunday of February");
  if ($today > $date) $date = date_create("last Sunday of February next year");
  echo "Дней до Масленицы: " . date_diff($today, $date)->days;
  ?>
```
7.	Дан инпут и кнопка. В этот инпут вводится дата рождения в формате '31.12'. По нажатию на кнопку выведите знак зодиака пользователя. 
```php
<form action="" method="post">
    <label>Дата рождения(ДД.ММ):</label>
    <input type="text" name="task7">
    <input type="submit" value="submit">
  </form>
  <?php
    function getZodiac($month, $day){
      $zodiacName = array(
          "Козерог", "Водолей", "Рыбы", 
          "Овен", "Телец", "Близнецы", 
          "Рак", "Лев", "Девы", 
          "Весы", "Скорпион", "Стрелец"
      );

      $zodiacDate = array(
          21, 20, 20, 20, 20, 20, 
          21, 22, 23, 23, 23, 23
      );

      if ($day < $zodiacDate[$month - 1]){
          $result = $zodiacName[$month - 1];
      }else{
          if($month == 12) $month = 0; 
          $result = $zodiacName[$month];
      }
      return $result;
    }

  if (isset($_POST["task7"])) {
    $str = $_POST["task7"];
    $date = explode(".", $str);
    if(count($date) > 1) {
      $zodiacSign = getZodiac($date[1], $date[0]);
      echo "Знак зодиака: " . $zodiacSign;
    }
  }
  ?>
```
8.	Дан массив праздников. По заходу на страницу, если сегодня праздник, то поздравьте пользователя с этим праздником.

```php 
<?php
  // Заполняем массив.
  $newYear = date("12-31");
  $hallowen = date("10-31");
  $christmas = date("01-07");
  $azerConstitute = date("11-12");
  $holidays = [
    $newYear => "Новый год",
    $hallowen => "Хэллоуин",
    $christmas => "Рождество Христово",
    $azerConstitute => "День Конституции Азербайджанской Республики"
  ];
  // Вывод.
  $today = date("m-d");
  foreach ($holidays as $key => $value) {
    if ($today == $key) {
      $output = "Поздравляем с праздником: $value!";
      break;
    }
    $output = "Сегодня нет никакого праздника";
  }
  echo $output;
  ?>
```
9.	Сделайте скрипт-гороскоп. Внутри него хранится массив гороскопов на несколько дней вперед для каждого знака зодиака. По заходу на страницу спросите у пользователя дату рождения, определите его знак зодиака и выведите предсказание для этого знака зодиака на текущий день.
```php
 <?php
  function GetHoroscopeFor($zodiacSign)
  {
    switch($zodiacSign){
        case 'Овен':
          return 'Сегодня Овны на коне – они настолько изобретательны и обаятельны, что у них получается абсолютно все. По ходу работы они еще и успевают влюбить в себя не одну душонку. Так держать. Гороскоп на сегодня для знака Овна советует не бояться рекламировать себя и свои таланты – заметит кто-то очень важный. А еще шутите больше – поднимайте всем настроение.'; 
          break;
        case 'Телец':
          return 'Сегодня Тельцы могут вляпаться в необычную историю, которая будет серьезно давить на нервы. Постарайтесь держать себя в руках и сохранять внутренний баланс, тогда быстро поймете, как выкрутиться. Гороскоп на сегодня для знака Тельца советует больше общаться и икать информацию везде – именно это станет вашей палочкой-выручалочкой. Обязательно блесните умом в сложной ситуации.'; 
          break;
        case 'Близнецы':
          return 'Сегодня Близнецам нужно флиртовать напропалую – вы не только влюбите в себя не один десяток, но и заметно продвинетесь по карьерной лестнице. Со всех сторон приятно. Гороскоп на сегодня для знака Близнецов советует вечером творить – возьмитесь за хобби и доведите свой шедевр до идеала. Это поднимет настроение и самооценку. Вам как раз нужно ее немного подтянуть.'; 
          break;
        case 'Рак':
          return 'Сегодня Ракам стоит на все смотреть через призму креатива – любая проблема решится только если вы дадите волю своим творческим порывам. Гороскоп на сегодня для знака Рака советует, подходя к какому-то делу, обязательно узнавать все его тонкости, – именно это поможет вам решить все задачи на отлично. Даже те, что со звездочкой. Доверьтесь своим идеям этим вечером.'; 
          break;
        case 'Лев':
          return 'Сегодня у Львов далеко не все пойдет по плану – некоторые ситуации будут вымораживать. Постарайтесь сильно не эмоционировать, а понять, почему это происходит – все не просто так. Гороскоп на сегодня для знака Льва советует лишний раз не грешить инициативой – скорее всего, вы лишь нагрузите себя работой и лишними проблемами. Зачем вам это нужно?'; 
          break;
        case 'Девы':
          return 'Сегодня Девам не стоит лишний раз проявлять инициативу или вляпываться в чужие истории – у вас и своих проблем предостаточно. Лучше быть ниже травы, тише воды и работать над легкими задачками. Гороскоп на сегодня для знака Девы советует быть осторожнее в романтических отношениях – сейчас ваша любовь может неожиданно оборваться, старайтесь сделать все, чтобы наладить связь.'; 
          break;
        case 'Весы':
          return 'Сегодня Весов вперед будут толкать не только цели, но и чужое поведение – вы будете вдохновляться теми, кто рядом. Работайте сообща, присоединяйтесь к их инициативам – будет и весело, и результативно. Гороскоп на сегодня для знака Весов советует вечер провести классно и с огоньком – можно куда-то выбраться, провести время со второй половинкой или удариться в крутое хобби. Главное – получить максимум приятных эмоций.'; 
          break;
        case 'Скорпион':
         return 'Сегодня Скорпионы заболеют карьерной болезнью – им захочется повышения здесь и сейчас. На удивление, звезды дают добро – можно просить, но при этом демонстрировать свои таланты. Гороскоп на сегодня для знака Скорпиона советует на каждую ситуацию смотреть по-философски – все несет некий смысл и урок, который стоит запомнить. В конце дня будет очень много мыслей в голове.'; 
          break;
        case 'Стрелец':
          return 'Сегодня Стрельцам не стоит терять время – будет миллион крутых возможностей заявить о себе и показать, на что вы способны. Сил для этого, кстати, будет предостаточно. Гороскоп на сегодня для знака Стрельца советует не бояться высказывать свои мысли – каждая сейчас на вес золота и может вдохновить окружающих. Не бойтесь действовать в необычных ситуациях – все, что придет в голову, будет верным.'; 
          break;
        case 'Козерог':
          return 'Сегодня у Козерогов далеко не легкий день – будет много проблем, и окружающие то и дело будут подставлять вам подножки. Старайтесь быть умнее и не отвечать агрессией на негатив. Гороскоп на сегодня для знака Козерога советует действовать быстрее, не считать ворон в непростой ситуации – у вас будут все шансы выйти из этой проблемки победителем, вынести не один урок.'; 
          break;
        case 'Водолей':
          return 'Сегодня Водолеи будут нарасхват – все захотят с ними общаться, выворачивать душу наизнанку и даже работать, а может, творить. Не отказывайтесь, но и на себя оставляйте время – вам оно нужно. Гороскоп на сегодня для знака Водолея советует не негативить, если происходит что-то неприятное – лучше подождать, когда ситуация изменится, на это уйдет на так уж и много времени.'; 
          break;
        case 'Рыбы':
          return 'Сегодня у Рыб будет крутой день, каждая минута которого будет насыщенна информацией – напитывайтесь знаниями. В будущем они вам очень даже помогут. Гороскоп на сегодня для знака Рыб советует искать компромиссы в непростых ситуациях – поверьте, они будут. И именно благодаря им ваши отношения станут только крепче. Так что ищите выходы, не уходите в негатив.'; 
          break;
    }
  }

  if (isset($_POST["task7"])) {
    $str = $_POST["task7"];
    $date = explode(".", $str);
    if(count($date) > 1) {
      $zodiacSign = getZodiac($date[1], $date[0]);
      echo "Знак зодиака: $zodiacSign.<br> Ваш гороскоп на сегодня:<br>" . GetHoroscopeFor($zodiacSign);
    }
  }
  ?>
```
10.	Дан текстареа и кнопка. В текстареа вводится текст. По нажатию на кнопку выведите количество слов в тексте, количество символов в тексте, количество символов за вычетом пробелов.
```php
<form action="" method="post">
    <textarea name="task10"></textarea>
    <input type="submit" value="sumbit">
  </form>
  <?php
  if (isset($_POST["task10"])) {
    $text = $_POST["task10"];
    $alphabet = "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя";
    echo "Количество слов: " . str_word_count($text, 0, $alphabet) . "<br>";
    echo "Количество символов: " . iconv_strlen($text) . "<br>";
    echo "Количество символов за вычетом пробелов: " . (iconv_strlen($text) - substr_count($text, " ")) . "<br>";
  }
  ?>
```
11.	Дан текстареа и кнопка. В текстареа вводится текст. По нажатию на кнопку нужно посчитать процентное содержание каждого символа в тексте.
```php
<form action="" method="post">
    <textarea name="task11"></textarea>
    <input type="submit" value="sumbit">
  </form>
  <?php
  if (isset($_POST["task11"])) {
    $text = $_POST["task11"];
    $len = mb_strlen($text);
    $chars_count = array_count_values(mb_str_split($text));
    foreach ($chars_count as $char => $count) {
      echo "$char - " . round($count / $len * 100, 0, PHP_ROUND_HALF_EVEN) . "%<br>";
    }
  }
  ?>
```
12.	Дан массив слов, инпут и кнопка. В инпут вводится набор букв. По нажатию на кнопку выведите на экран те слова, которые содержат в себе все введенные буквы.
```php
<form action="" method="post">
    <label>Набор букв:</label>
    <input type="text" name="task12">
    <input type="submit" value="submit">
  </form>
  <?php
  if (isset($_POST["task12"])) {
    $letters = mb_str_split($_POST["task12"]);
    $words = ["папа", "мама", "брат", "сестра", "малыш", "машина", "карета", "утро", "день", "вечер", "ночь", "обед", "сегодня", "завтра", "весело", "хорошо", "да", "нет", "один", "два", "три"];
    $result = [];
    foreach ($words as $word) {
      $inString = true;
      foreach ($letters as $letter) {
        if (mb_stripos($word, $letter) === false) {
          $inString = false;
          break;
        }
      }
      if ($inString) array_push($result, $word);
    }

    echo "Слова, которые содержат все введенные буквы:<br>";
    for ($i = count($result) - 1; $i >= 0; $i--) {
      echo $result[$i];
      if ($i > 0) echo ", ";
    }
  }
  ?>
```
13.	Дан текстареа и кнопка. В текстареа через пробел вводятся слова. По нажатию на кнопку выведите слова в таком виде: сначала заголовок 'слова на букву а' и под ним все слова, которые начинаются на 'а', потом заголовок 'слова на букву б' и все слова на 'б' и так далее. Буквы должны идти в алфавитном порядке. Брать следует только те буквы, на которые начинаются наши слова. То есть: если нет слов, к примеру, на букву 'в' - такого заголовка тоже не будет.
```php
<form action="" method="post">
    <textarea name="task13"></textarea>
    <input type="submit" value="submit">
  </form>
  <?php
  if (isset($_POST["task13"])) {
    $words = explode(" ", $_POST["task13"]);
    sort($words);
    $prev = "";
    foreach ($words as $word) {
      $char = mb_str_split($word)[0];
      if ($prev !== $char)
        echo "<br>Слова на букву " . $char . ": ";
      else
        echo ", ";
      echo $word;
      $prev = $char;
    }
  }
  ?>
```
14.	Дан инпут и кнопка. В этот инпут вводится строка на русском языке. По нажатию на кнопку выведите на экран транслит этой строки.
```php
<form action="" method="post">
    <label>Строка на русском:</label>
    <input type="text" name="task14">
    <input type="submit" value="submit">
  </form>
  <?php
  function RusToLat($source = false)
  {
      if ($source) {
          $rus = [
              "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ы", "Ь", "Э", "Ю", "Я",
              "а", "б", "в", "г", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы", "ь", "э", "ю", "я"
          ];
          $lat = [
              "A", "B", "V", "G", "D", "E", "Yo", "Zh", "Z", "I", "J", "K", "L", "M", "N", "O", "P", "R", "S", "T", "U", "F", "H", "C", "Ch", "Sh", "Shh", "\`\`", "Y`", "`", "E`", "Yu", "Ya", "a", "b", "v", "g", "d", "e", "yo", "zh", "z", "i", "j", "k", "l", "m", "n", "o", "p", "r", "s", "t", "u", "f", "h", "c", "ch", "sh", "shh", "``", "y`", "`", "e`", "yu", "ya"
          ];
          return str_replace($rus, $lat, $source);
      }
  }

  if (isset($_POST["task14"])) {
    echo "Транслит: " . RusToLat($_POST["task14"]);
  }
  ?>
```
15.	Дан инпут, 2 радиокнопочки и кнопка. В инпут вводится строка, а с помощью радиокнопочек выбирается - нужно преобразовать эту строку в транслит или из транслита обратно.
```php
<form action="" method="get">
    <input type="text" name="task15">
    <input type="submit" value="submit"><br>
    <input type="radio" name="radio15" value="To" checked><label>В транслит</label>
    <input type="radio" name="radio15" value="From"><label>Из транслита</label>
  </form>
  <?php
  function LatToRus($source = false)
  {
      if ($source) {
          $rus = [
              "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ы", "Ь", "Э", "Ю", "Я",
              "а", "б", "в", "г", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы", "ь", "э", "ю", "я"
          ];
          $lat = [
              "A", "B", "V", "G", "D", "E", "Yo", "Zh", "Z", "I", "J", "K", "L", "M", "N", "O", "P", "R", "S", "T", "U", "F", "H", "C", "Ch", "Sh", "Shh", "\`\`", "Y`", "`", "E`", "Yu", "Ya", "a", "b", "v", "g", "d", "e", "yo", "zh", "z", "i", "j", "k", "l", "m", "n", "o", "p", "r", "s", "t", "u", "f", "h", "c", "ch", "sh", "shh", "``", "y`", "`", "e`", "yu", "ya"
          ];
          return str_replace($lat, $rus, $source);
      }
  }

  if (isset($_POST["task15"])) {
    if ($_POST["radio15"] === "To")
      echo "Транслит: " . RusToLat($_POST["task15"]);
    else
      echo "Перевод: " . LatToRus($_POST["task15"]);
  }
  ?>
```
16.	Дан массив с вопросами и правильными ответами. Реализуйте тест: выведите на экран все вопросы, под каждым инпут. Пользователь читает вопрос, пишет свой ответ в инпут. Когда вопросы заканчиваются - он жмет на кнопку, страница обновляется и вместо инпутов под вопросами появляется сообщение вида: 'ваш ответ: ... верно!' или 'ваш ответ: ... неверно! Правильный ответ: ...'. Правильно отвеченные вопросы должны гореть зеленым цветом, а неправильно - красным.
```php
<style>
    .correct {
      background-color: limegreen;
    }

    .wrong {
      background-color: red;
    }
  </style>
  <p><b>Ответы "да" или "нет":</b></p>
  <form action="" method="post">
    <?php
    $quests = [
      "Вопрос 1" => "да",
      "Вопрос 2" => "нет",
      "Вопрос 3" => "нет",
      "Вопрос 4" => "да",
      "Вопрос 5" => "нет",
    ];

    $i = 0;
    foreach ($quests as $quest => $answer) {
      echo $quest . "<br>";
      if (isset($_POST["q$i"])) {
        echo "<p>Ваш ответ: " . $_POST["q$i"] . " - ";
        if ($_POST["q$i"] === $answer)
          echo '<span class = "correct">верно!';
        else
          echo '<span class = "wrong">неверно!';
        echo "</span></p>";
      } else
        echo '<input type="text" name="q' . $i . '"><br>';

      $i++;
    }
    ?>
    <input type="submit" value="submit">
  </form>

```
17.	Модифицируем предыдущую задачу: пусть теперь тест показывает варианты ответов и радиокнопочки. Пользователь должен выбрать один и вариантов.
```php
<form action="" method="post">
    <?php
    $quests = [
      "Вопрос 1" => "да",
      "Вопрос 2" => "нет",
      "Вопрос 3" => "нет",
      "Вопрос 4" => "да",
      "Вопрос 5" => "нет",
    ];

    $i = 0;
    foreach ($quests as $quest => $answer) {
      echo $quest . "<br>";
      if (isset($_POST["radio17$i"])) {
        echo "<p>Ваш ответ: " . $_POST["radio17$i"] . " - ";
        if ($_POST["radio17$i"] === $answer)
          echo '<span class = "correct">верно!';
        else
          echo '<span class = "wrong">неверно!';
        echo "</span></p>";
      } else
        echo '
        <input type="radio" name="radio17' . $i . '" value="да">
        <label>да</label>
        <input type="radio" name="radio17' . $i . '" value="нет">
        <label>нет</label>
        <br>
        ';

      $i++;
    }
    ?>
    <input type="submit" value="submit">
  </form>
```
18.	Модифицируем предыдущую задачу: пусть теперь на один вопрос может быть несколько правильных ответов. Пользователь должен отметить один или несколько чекбоксов.
```php
<form action="" method="post">
    <?php
    $quests = [
      "Вопрос 1" => ["да", "нет"],
      "Вопрос 2" => ["нет", "не знаю"],
      "Вопрос 3" => ["нет"],
      "Вопрос 4" => ["да"],
      "Вопрос 5" => ["да", "не знаю"],
    ];

    $variants = [
      ["да", "нет", "не знаю"],
      ["да", "нет", "не знаю"],
      ["да", "нет", "не знаю"],
      ["да", "нет", "не знаю"],
      ["да", "нет", "не знаю"],
    ];

    $i = 0;
    foreach ($quests as $quest => $answer) {
      // Вопрос №
      echo $quest . "<br>";
      // Ваш ответ: 
      if (isset($_POST["submit"])) {
        echo "Ваш ответ: [";
        $userAnswer = [];
        for ($j = 0; $j < count($variants[$i]); $j++) {
          if (isset($_POST["radio18$i$j"])) {
            array_push($userAnswer, $_POST["radio18$i$j"]);
          }
        }
        // Ответ
        echo implode(", ", $userAnswer) . "] - ";
        // Верно/Неверно
        if (!array_diff($userAnswer, $answer) && !array_diff($answer, $userAnswer))
          echo '<span class = "correct">верно!';
        else
          echo '<span class = "wrong">неверно!';
        echo "</span></p>";
      } else {
        // Чекбоксы  
        for ($j = 0; $j < count($variants[$i]); $j++)
          echo '
            <input type="checkbox" name="radio18' . $i . $j . '" value="' . $variants[$i][$j] . '">
            <label>' . $variants[$i][$j] . '</label>
          ';
        echo "<br>";
      }
      $i++;
    }

    if (isset($_POST["reset"])) $_POST["submit"] = "";
    ?>
    <input type="submit" name="submit" value="submit">
    <input type="submit" name="reset" value="reset">
  </form>
```
19.	Напишите скрипт, который будет считать факториал числа. Само число вводится в инпут и после нажатия на кнопку пользователь должен увидеть результат.

```php
<form action="" method="post">
    <input type="text" name="task19">
    <input type="submit" value="submit">
  </form>
  <?php
  if (isset($_POST["task19"])) {
    $num = $_POST["task19"];
    $res = 1;
    for ($i = 1; $i <= $num; $i++) {
      $res *= $i;
    }
    echo "Ответ: " . $res;
  }
  ?>
```
20.	Напишите скрипт, который будет находить корни квадратного уравнения. Для этого сделайте 3 инпута, в которые будут вводиться коэффициенты уравнения.
```php
<form action="" method="post">
    <label>a = </label>
    <input type="text" name="task20a">
    <label>b = </label>
    <input type="text" name="task20b">
    <label>c = </label>
    <input type="text" name="task20c">
    <br>
    <input type="submit" name="task20sbm" value="submit">
  </form>
  <?php
  if (isset($_POST["task20sbm"])) {
    $a = $_POST["task20a"];
    $b = $_POST["task20b"];
    $c = $_POST["task20c"];
    $D = $b * $b - 4 * $a * $c;
    $d = sqrt(abs($D));

    echo "Ответ: ";
    if ($D == 0) {
      echo "x = " . (-$b + $d) / 2 / $a;
    } else if ($D > 0) {
      echo "x1 = " . (-$b + $d) / 2 / $a . ", ";
      echo "x2 = " . (-$b - $d) / 2 / $a;
    } else {
      echo "x1/2 = (" . -$b . htmlspecialchars_decode("&plusmn", ENT_QUOTES) . $d . "i) / " . 2 * $a;
    }
  }
  ?>
```
21.	Даны 3 инпута. В них вводятся числа. Проверьте, что эти числа являются тройкой Пифагора: квадрат самого большого числа должен быть равен сумме квадратов двух остальных.

```php
<form action="" method="post">
    <label>a = </label>
    <input type="text" name="task21a">
    <label>b = </label>
    <input type="text" name="task21b">
    <label>c = </label>
    <input type="text" name="task21c">
    <br>
    <input type="submit" name="task21sbm" value="submit">
  </form>
  <?php
  if (isset($_POST["task21sbm"])) {
    $a = $_POST["task21a"];
    $b = $_POST["task21b"];
    $c = $_POST["task21c"];
    $sum = 0;
    $max;
    if ($a > $b) {
      $sum += $b * $b;
      $max = $a;
    } else {
      $sum += $a * $a;
      $max = $b;
    }
    if ($max > $c) {
      $sum += $c * $c;
      $max *= $max;
    } else {
      $sum += $max * $max;
      $max = $c * $c;
    }

    if ($max == $sum) echo "Тройка Пифагора";
    else echo "Не тройка Пифагора";
  }
  ?>
  
```
22.	Дан инпут и кнопка. В инпут вводится число. По нажатию на кнопку выведите список делителей этого числа.
```php
<form action="" method="post">
    <input type="text" name="task22">
    <input type="submit" value="submit">
  </form>
  <?php
  if (isset($_POST["task22"])) {
    $num = $_POST["task22"];
    $results = [];
    for ($i = 1; $i <= intdiv($num, 2); $i++) {
      if ($num % $i == 0)
        array_push($results, $i);
    }

    echo "Делители: " . implode(", ", $results);
  }
  ?>
```
23.	Дан инпут и кнопка. В инпут вводится число. По нажатию на кнопку разложите число на простые множители.
```php
<form action="" method="post">
    <input type="text" name="task23">
    <input type="submit" value="submit">
  </form>
  <?php
  if (isset($_POST["task23"])) {
    $num = $_POST["task23"];
    $results = [];
    $i = 1;
    while ($num != 1) {
      $i++;
      if ($num % $i == 0) {
        $num /= $i;
        array_push($results, $i);
        $i = 1;
      }
    }

    echo "Простые множители: " . implode(", ", $results);
  }
```
24.	Даны 2 инпута и кнопка. В инпуты вводятся числа. По нажатию на кнопку выведите список общих делителей этих двух чисел.
```php
<form action="" method="post">
    <input type="text" name="task24a">
    <input type="text" name="task24b">
    <input type="submit" value="submit">
  </form>
  <?php
  if (isset($_POST["task24a"]) && isset($_POST["task24b"])) {
    $a = $_POST["task24a"];
    $b = $_POST["task24b"];
    $results = [];
    for ($i = 1; $i <= intdiv(max($a, $b), 2); $i++) {
      if ($a % $i == 0 && $b % $i == 0)
        array_push($results, $i);
    }

    echo "Общие делители: " . implode(", ", $results);
  }
  ?>
```
25.	Даны 2 инпута и кнопка. В инпуты вводятся числа. По нажатию на кнопку выведите наибольший общий делитель этих двух чисел.
```PHP
<form action="" method="post">
    <input type="text" name="task25a">
    <input type="text" name="task25b">
    <input type="submit" value="submit">
  </form>
  <?php
  if (isset($_POST["task25a"]) && isset($_POST["task25b"])) {
    $a = $_POST["task25a"];
    $b = $_POST["task25b"];
    echo "НОД = " . gcd($a, $b);
  }

  function gcd($a, $b)
  {
    $a = abs($a);
    $b = abs($b);
    while ($b) {
      $temp = $b;
      $b = $a % $b;
      $a = $temp;
    }
    return $a;
  }
  ?>
```
26.	Даны 2 инпута и кнопка. В инпуты вводятся числа. По нажатию на кнопку выведите наименьшее число, которое делится и на одно, и на второе из введенных чисел.
```php
<form action="" method="post">
    <input type="text" name="task26a">
    <input type="text" name="task26b">
    <input type="submit" value="submit">
  </form>
  <?php
  if (isset($_POST["task26a"]) && isset($_POST["task26b"])) {
    $a = $_POST["task26a"];
    $b = $_POST["task26b"];
    echo "НОК = " . lcm($a, $b);
  }

  function lcm($a, $b)
  {
    return abs($a * $b / gcd($a, $b));
  }
  ?>
  
```
27.	Даны 3 селекта и кнопка. Первый селект - это дни от 1 до 31, второй селект - это месяцы от января до декабря, а третий - это годы от 1990 до 2025. С помощью этих селектов можно выбрать дату. По нажатию на кнопку выведите на экран день недели, соответствующий этой дате, например, ‘воскресенье'.
```php
<form action="" method="post">
    <input type="text" name="task27a">
    <input type="text" name="task27b">
    <input type="text" name="task27c">
    <input type="submit" value="submit">
  </form>
  <?php
  if (isset($_POST["task27a"]) && isset($_POST["task27b"]) && isset($_POST["task27c"])) {
    $d = $_POST["task27a"];
    $m = $_POST["task27b"];
    $y = $_POST["task27c"];
    $days = ["понедельник", "вторник", "среда", "четверг", "пятница", "суббота", "воскресенье"];

    echo "$d-$m-$y - " . $days[date("N", strtotime("$d.$m.$y")) - 1];
  }
  ?>
```
<center><b><p>
Задание. «Гостевая книга» (PHP)
Гостевая книга предоставляет возможность пользователям сайта оставлять сообщения на сайте. Все данные введенные пользователем сохраняются в БД MySQL, так же в базе данных сохраняются данные о IP пользователя и его браузере.
Форма добавления записи в гостевую книгу должна иметь следующие поля:
▪	User Name (цифры и буквы латинского алфавита) – обязательное поле
▪	E-mail (формат email) – обязательное поле
▪	Homepage (формат url) – необязательное поле
▪	CAPTCHA (цифры и буквы латинского алфавита) – изображение и обязательное поле (http://ru.wikipedia.org/wiki/CAPTCHA)
▪	Text (непосредственно сам текст сообщения, HTML тэги недопустимы) – обязательное поле
Сообщения должны выводится в виде таблицы, с возможностью сортировки по следующим полям: User Name, e-mail, и дата добавления (как в порядке убывания, так и в обратном). Сообщения должны разбиваться на страницы по 25 сообщений на каждой. Сортировка по умолчанию – LIFO.
При написании проекта следует обратить внимание на защиту от XSS атак и SQL –инъекций. (http://ru.wikipedia.org/wiki/Межсайтовый_скриптинг и http://ru.wikipedia.org/wiki/Инъекция_SQL)
Приветствуется создания простейшего дизайна с использованием CSS.
index.php
```html
<!DOCTYPE html>
<html>
<head>
<title>Гостевая книга</title>
<link rel="stylesheet" href="styles1.css">
<meta charset="utf-8">
</head>
<body>
<nav>
	<ul>
		<li><a href='C:\Users\Admin\Desktop\newweb\js9\index.php'>Задания</a></li>
		<li><a href='guests.php'>Посмотреть сообщения</a></li>
	</ul>
</nav>
<form action="process_form.php" method="post">
	<label>Your name (Dima)</label><br>
    <input type="text" name="userName" pattern="[A-Za-z0-9]{3,50}" required><br>
	<label>Email (example@mail.com)</label><br>
    <input type="email" name="email" required><br>
	<label>Homepage (https://example.com)</label><br>
    <input type="url" name="homepage"><br>
	<label>CAPTCHA</label><br>
	<img src = "captcha.php"><br>
	<input type = "text" name = "kapcha"  pattern="[A-Za-z0-9]{5}" required><br><br>
	<label>Your message</label><br>
    <br><textarea name="message" rows="4" cols="50" required></textarea><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>
```
process_form.php

```php
<?php
session_start();
if($_POST['kapcha'] != $_SESSION['rand_code']) echo "Капча введена неверно";
else{
$redirect = "./ok.php"; // адрес страницы, на которую нужно перейти при успешной отправке сообщения

// Подключение к базе данных
$servername = "hostname";
$username = "username";
$password = "passwd";
$dbname = "name";
/* $servername: Для OpenServer используется localhost.
$username: По умолчанию в OpenServer это root.
$password: в OpenServer пароль по умолчанию отсутствует.
$dbname: Название вашей базы данных (например, guestbook).
*/
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Обработка данных из формы
$userName = mysqli_real_escape_string($conn, $_POST['userName']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$homepage = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['homepage']));
$captchaCode = mysqli_real_escape_string($conn, $_POST['kapcha']);
$text =  htmlspecialchars(mysqli_real_escape_string($conn, $_POST['message']));
$ipAddress = $_SERVER['REMOTE_ADDR'];
$browserInfo = $_SERVER['HTTP_USER_AGENT'];
$date = date("Y-m-d H:i:s"); 

// SQL запрос для добавления записи в базу данных
$sql = "INSERT INTO `messages` (user, email, homepage, captcha, text, ip, browser, date)
        VALUES ('$userName', '$email', '$homepage', '$captchaCode', '$text', '$ipAddress', '$browserInfo','$date')";

if ($conn->query($sql) === TRUE) {
    header('Location: '.$redirect);
} else {
	header('Location: ' . "./error.php");
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
?>
```
captcha.php
```php
<?php
session_start();
header("Content-type: image/png");

$image = imagecreate(120, 40);
$background = imagecolorallocate($image, 255, 255, 255); // белый фон
$text_color = imagecolorallocate($image, 0, 0, 0);       // черный текст

$captcha_code = '';
for ($i = 0; $i < 5; $i++) {
    $captcha_code .= chr(rand(65, 90)); // Генерация случайной буквы
}
$_SESSION['rand_code'] = $captcha_code;

imagestring($image, 5, 30, 10, $captcha_code, $text_color);
imagepng($image);
imagedestroy($image);
?>
```

guests.php

```php
<!DOCTYPE html>
<html>
<head>
<title>Гостевая книга(lab_№9)</title>
<link rel="stylesheet" href="style.css">
<style>
    body{
        background-color:bisque;
    }
</style>
<meta charset="utf-8">
</head>
<nav>
	<ul>
		<li><a href="index.php">На главную</a></li>
	</ul>
</nav>
<body>
<?php
// Подключение к базе данных
$servername = "hostname";
$username = "username";
$password = "passwd";
$dbname = "name";

$items_per_page = 25;
$page = isset($_GET['page']) ? $_GET['page'] : 1; //Номер страницы из запроса
$offset = ($page - 1) * $items_per_page;

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Порядок сортировки таблицы
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'date';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'DESC';

// Получение сообщений SQL-запросом
$sql = "SELECT user, email, text, date FROM `messages` ORDER BY $sort_by $sort_order LIMIT $offset, $items_per_page";
$result = $conn->query($sql);

$a = $conn->query("SELECT COUNT(*) as count FROM `messages`");
$b = $a->fetch_assoc();
$count = intdiv($b["count"] , $items_per_page) + 1;
$total_pages = $count; // Количество страниц

// Вывод данных в виде таблицы
if ($result->num_rows > 0) {
    echo "<table><tr>
    <th>UserName
    <a href = http://my_websyte/guests.php?sort_by=username&sort_order=ASC>↑</a>
    <a href = http://my_websyte/guests.php?sort_by=username&sort_order=DESC>↓</a>
    </th> 
    <th>Email
    <a href = http://my_websyte/guests.php?sort_by=email&sort_order=ASC>↑</a>
    <a href = http://my_websyte/guests.php?sort_by=email&sort_order=DESC>↓</a>
    </th>
    <th>Text
    <a href = http://my_websyte/guests.php?sort_by=text&sort_order=ASC>↑</a>
    <a href = http://my_websyte/guests.php?sort_by=text&sort_order=DESC>↓</a>
    </th>
    <th>Date
    <a href = http://my_websyte/guests.php?sort_by=date&sort_order=ASC>↑</a>
    <a href = http://my_websyte/guests.php?sort_by=date&sort_order=DESC>↓</a>
    </th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["user"] . "</td><td>" . $row["email"] . "</td><td>" . $row["text"] . "</td><td>" . $row["date"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
//Вывод ссылок на страницы
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href = http://my_websyte/guests.php?sort_by=$sort_by&sort_order=$sort_order&page=$i>$i</a> ";
}
$conn->close();
?>
</form>
</body>
</html>
```
</p></b></center>
## <center>_Вывод_</center>
Таким образом, мне удалось поработать с перемнными в PHP, научиться правильно писать их имена, также работал с циклами  и массивами.