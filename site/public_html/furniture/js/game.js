const cards = document.querySelectorAll('.memory-card');
let moviment = 0 ;
let acerto = 0 ;
let hasFlippedCard = false;
let lockBoard = false;
let firstCard, secondCard;
function flipCard() {
  if (lockBoard) return;
  if (this === firstCard) return;
  this.classList.add('flip');
  if (!hasFlippedCard) {
    hasFlippedCard = true;
    firstCard = this;
    return;
  }
  secondCard = this;
  moviment++;
  checkForMatch();
}

function checkForMatch() {
  let isMatch = firstCard.dataset.framework === secondCard.dataset.framework;
  isMatch ? disableCards() : unflipCards();
}

function disableCards() {
  firstCard.removeEventListener('click', flipCard);
  secondCard.removeEventListener('click', flipCard);
  resetBoard();
  setTimeout(() => {
    if( cards.length == document.querySelectorAll('.flip').length ){
      var formData = new FormData();
      formData.append("btn_save", "yes");
      formData.append("moviment", document.querySelectorAll('.flip').length / 2 );
        var request = new XMLHttpRequest();
        request.open("POST", "/jogo-da-memoria");
        request.send(formData);
        document.location = "/jogo-da-memoria/finalizado" ;
    } 
  }, 1000);
}

function unflipCards() {
  lockBoard = true;
  setTimeout(() => {
    firstCard.classList.remove('flip');
    secondCard.classList.remove('flip');
    resetBoard();
  }, 1500);
}

function resetBoard() {
  [hasFlippedCard, lockBoard] = [false, false];
  [firstCard, secondCard] = [null, null];
}

(function shuffle() {
  cards.forEach(card => {
    let randomPos = Math.floor(Math.random() * 12);
    card.style.order = randomPos;
  });
})();

cards.forEach(card => card.addEventListener('click', flipCard));
