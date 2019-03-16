import { Personne } from './personne-model';

export const PERSONNES = [
  { id: 11, nom: 'Durant', prenom: 'Georges', s1: 13, s2: 1, s3: 4, s4: 14 },
  { id: 12, nom: 'Audin', prenom: 'Patrick', s1: 13, s2: 1, s3: 4, s4: 14 },
  { id: 13, nom: 'Bertin', prenom: 'Sophie', s1: 13, s2: 1, s3: 4, s4: 14 },
  { id: 14, nom: 'Varon', prenom: 'Julie', s1: 13, s2: 1, s3: 4, s4: 14 },
  { id: 15, nom: 'Tapour', prenom: 'Jean-Pierre', s1: 13, s2: 1, s3: 4, s4: 14 },
  { id: 16, nom: 'Prusier', prenom: 'Serge', s1: 13, s2: 1, s3: 4, s4: 14, s5: 12, avatar: './homme.jpg', numero: 20172345,
    sm1 : {moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
    sm2 : {moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5} },
  { id: 17, nom: 'Figier', prenom: 'Adam', s1: 13, s2: 1, s3: 4, s4: 14 },
  { id: 18, nom: 'Bonno', prenom: 'Thierry', s1: 13, s2: 1, s3: 4, s4: 14 },
  { id: 19, nom: 'Quantelier', prenom: 'Stéphane' , s1: 13, s2: 1, s3: 4, s4: 14},
  { id: 20, nom: 'Hister', prenom: 'Louis', s1: 13, s2: 1, s3: 4, s4: 14 }
];



export const PROMO1 = [
  { id: 16, nom: 'Prusier', prenom: 'Serge' , s1: 13, s2: 1, s3: 4, s4: 14, s5: 12, avatar: 'app/homme.jpg', numero: 20172345 },
  { id: 17, nom: 'Figier', prenom: 'Adam', s1: 13, s2: 1, s3: 4, s4: 14 },
  { id: 18, nom: 'Bonno', prenom: 'Thierry', s1: 13, s2: 1, s3: 4, s4: 14 },
  { id: 19, nom: 'Quantelier', prenom: 'Stéphane', s1: 13, s2: 1, s3: 4, s4: 14 },
  { id: 20, nom: 'Hister', prenom: 'Louis', s1: 13, s2: 1, s3: 4, s4: 14 }
];

export const PROMO2 = [
  { id: 11, nom: 'Durant', prenom: 'Georges' , s1: 13, s2: 1, s3: 4, s4: 14},
  { id: 12, nom: 'Audin', prenom: 'Patrick' , s1: 13, s2: 1, s3: 4, s4: 14},
  { id: 13, nom: 'Bertin', prenom: 'Sophie', s1: 13, s2: 1, s3: 4, s4: 14 },
  { id: 14, nom: 'Varon', prenom: 'Julie', s1: 13, s2: 1, s3: 4, s4: 14 },
  { id: 15, nom: 'Tapour', prenom: 'Jean-Pierre', s1: 13, s2: 1, s3: 4, s4: 14 }
];

export const PERSONNES2 = [
  PROMO1, PROMO2
];
