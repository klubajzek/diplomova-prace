jQuery(document).ready(function($) {
   let mistakes = [];
   let corrects = [];

   $('.question-row').on('click', function() {
       $('.question-row.active').removeClass('active');

       $(this).addClass('active');

       checkItems();
   });

   $('.answer-row').on('click', function() {
       $('.answer-row.active').removeClass('active');

       $(this).addClass('active');

       checkItems();
   });

   function checkItems() {
       let question = $('.question-row.active');
       let answer = $('.answer-row.active');

       if (question.length === 0 || answer.length === 0) {
           return;
       }

       let values = (question.text()).split(' ');

       if (values.length < 3) {
          return;
       }

       let answerValue = getAnswer(values);

       if (answerValue === parseInt(answer.text())) {
           corrects.push({
               question: question.data('id'),
               answer: answer.data('id')
           });

            question.removeClass('active').addClass('correct').addClass('result');
            answer.removeClass('active').addClass('correct').addClass('result');
       } else {
           mistakes.push({
               question: question.data('id'),
               answer: answer.data('id')
           });

           question.removeClass('active').addClass('mistake').addClass('result');
           answer.removeClass('active').addClass('mistake').addClass('result');
       }

       let valid = isStillValidItems();

       if (!valid) {
           finishGame();
       }

       hideElements();
   }

   function isStillValidItems() {
       let stillValid = false;
       $('.question-row:not(.result)').each(function () {
           let questionValues = $(this).text().split(' ');
           if (questionValues.length === 3 && !stillValid) {
               let answerValue = getAnswer(questionValues);
               if ($('.answer-row[data-answer="' + answerValue + '"]:not(.result)').length > 0) {
                   stillValid = true;
               }
           }
       });

       return stillValid;
   }

   function getAnswer(values) {
       let answer = 0;

       switch (values[1]) {
           case '+':
               answer = parseInt(values[0]) + parseInt(values[2]);
               break;
           case '-':
               answer = parseInt(values[0]) - parseInt(values[2]);
               break;
           case '*':
               answer = parseInt(values[0]) * parseInt(values[2]);
               break;
           case '/':
               answer = parseInt(values[0]) / parseInt(values[2]);
               break;
       }

       return answer;
   }

   function hideElements() {
       setTimeout(function () {
           $('.question-row.result').fadeOut("slow");
           $('.answer-row.result').fadeOut("slow");
       }, 500)
   }

   function finishGame() {
         let url = $('.mini-game-match').data('url');

         $.ajax({
              url: url,
              type: 'POST',
              data: {
                mistakes: mistakes,
                corrects: corrects
              },
              success: function (response) {
                  if (response.success) {
                      window.location.href = response.url;
                  }
              }
         });
   }
});