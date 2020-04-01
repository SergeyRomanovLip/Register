function createModal(modalType) {
  modal = "modal_" + modalType;
  var text = f;

  function f(modalType) {
    var text_f = null;
    if (modal == "modal_enter") {
      text_f = '<h1 class="enter-nohover">Проход на предприятие</h1>';
    } else {
      text_f = '<h1 class="exit-nohover">Выход с предприятия</h1>';
    }
    return text_f;
  }

  var text2 = g;

  function g(modalType) {
    var text_g = null;
    if (modal == "modal_enter") {
      text_g = "enter_input";
    } else {
      text_g = "exit_input";
    }
    return text_g;
  }
  var container = document.getElementById("container");
  container.innerHTML =
    '<div id="modal_enter" class="' +
    modal +
    '">' +
    '<div class="darker">' +
    text() +
    '<label for="' +
    text2() +
    '">Укажите номер вашей <strong>карты питания</strong><br>в поле ниже</label>' +
    '<input id="' +
    text2() +
    '" class="input_form" type="number" name="Номер карты" placeholder="Номер карты" >' +
    '<input id="enter_submit" class="input_form enter" type="submit" name="submit" value="Отправить"' +
    'onclick="checkData(getElementById(`' +
    text2() +
    '`))"' +
    ">" +
    '<input id="cancel_submit" class="input_form exit" type="submit" name="submit" value="Отменить" onclick="cancelFirstModal()">' +
    '<div id="result_enter"></div>' +
    "</div>";
}

function cancelFirstModal() {
  document.getElementById("modal_enter").remove();
}

function cancelSecModal() {
  document.getElementById("temporary").remove();
}

function writeRegister() {
  var employeNumWrite = document.getElementById("enter_input").value;
  requestDataWrite = $.ajax({
    type: "POST",
    url: "http://isinfo.h910230154.nichost.ru/bd.php",
    dataType: "json",
    data: { id_card_write: employeNumWrite },
    success: function(data) {
      var result = data;
      alert(result);
      cancelSecModal();
      cancelFirstModal();
    }
  });
}

function writeRegisterExit() {
  var employeNumWrite = document.getElementById("exit_input").value;
  requestDataWrite = $.ajax({
    type: "POST",
    url: "http://isinfo.h910230154.nichost.ru/bd.php",
    dataType: "json",
    data: { id_card_write_exit: employeNumWrite },
    success: function(data) {
      var result = data;
      alert(result);
      cancelSecModal();
      cancelFirstModal();
    }
  });
}

function checkData(checkData) {
  var typeOfSend = checkData.id;
  if (typeOfSend == "enter_input") {
    employeNum = checkData.value;
    requestData = $.ajax({
      type: "POST",
      url: "http://isinfo.h910230154.nichost.ru/bd.php",
      dataType: "json",
      data: { id_card: employeNum },
      success: function(data) {
        var username = data;
        if (username != null) {
          f = username.first_name;
          l = username.last_name;
          s = username.sur_name;
          var parsedData = "Вы " + l + " " + f + " " + s + "?";
          var message = document.getElementById("result_enter");
          message.innerHTML =
            "<div id='temporary' class='modal'>" +
            '<div class="approve_form darker">' +
            "<h1>" +
            parsedData +
            "</h1>" +
            '<input id="enter_submit1" class="input_form enter" type="submit" name="submit" value="Подтвердить"' +
            'onclick="writeRegister()")' +
            ">" +
            '<input id="enter_submit2" class="input_form exit" type="submit" name="submit" value="Отменить"' +
            'onclick="cancelSecModal()"' +
            ">" +
            "</div>" +
            "</div>";
        } else {
          alert(
            "Данный номер отсутствует в системе. Обратитесь к работникам КПП"
          );
          document.getElementById("enter_input").value = null;
        }
      }
    });
  } else {
    employeNum = checkData.value;
    requestData = $.ajax({
      type: "POST",
      url: "http://isinfo.h910230154.nichost.ru/bd.php",
      dataType: "json",
      data: { id_card: employeNum },
      success: function(data) {
        var username = data;
        if (username != null) {
          f = username.first_name;
          l = username.last_name;
          s = username.sur_name;
          var parsedData = "Вы " + l + " " + f + " " + s + "?";
          var message = document.getElementById("result_enter");
          message.innerHTML =
            "<div id='temporary' class='modal'>" +
            '<div class="approve_form darker">' +
            "<h1>" +
            parsedData +
            "</h1>" +
            '<input id="enter_submit1" class="input_form enter" type="submit" name="submit" value="Подтвердить"' +
            'onclick="writeRegisterExit()")' +
            ">" +
            '<input id="enter_submit2" class="input_form exit" type="submit" name="submit" value="Отменить"' +
            'onclick="cancelSecModal()"' +
            ">" +
            "</div>" +
            "</div>";
        } else {
          alert(
            "Данный номер отсутствует в системе. Обратитесь к работникам КПП"
          );
          document.getElementById("enter_input").value = null;
        }
      }
    });
  }
}
