import { Personne } from './personne-model';

export const PERSONNES = [
  { id: 11, nom: 'Durant', prenom: 'Georges', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
          matieres : [
            {nom:'Anglais', moyenne: 14, classement: 4, moyennePromo: 13, promoMax: 19, promoMin: 11}
          ]},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
            matieres : [
              {nom:'AP', moyenne: 5, classement: 37, moyennePromo: 11, promoMax: 15, promoMin: 1}
            ]}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 9, moyennePromo: 11, promoMax: 19, promoMin: 9,
            matieres : [
              {nom:'Anglais', moyenne: 14, classement: 4, moyennePromo: 13, promoMax: 19, promoMin: 11}
            ]},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
            matieres : [
              {nom:'BD', moyenne: 9, classement: 27, moyennePromo: 12, promoMax: 15, promoMin: 5}
            ]}]
      },
      {id : 3 ,moyenne: 11, classement : 25, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 8, moyennePromo: 11, promoMax: 19, promoMin: 9,
            matieres : [
              {nom:'Anglais', moyenne: 14, classement: 4, moyennePromo: 13, promoMax: 19, promoMin: 11}
            ]},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
            matieres : [
              {nom:'BD2', moyenne: 11, classement: 24, moyennePromo: 12, promoMax: 14, promoMin: 7}
            ]},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
            matieres : [
              {nom:'Projet tutoré', moyenne: 15, classement: 6, moyennePromo: 15, promoMax: 17, promoMin: 8}
            ]}]
      },
      {id : 4, moyenne: 11, classement : 20, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
            matieres : [
              {nom:'Anglais', moyenne: 14, classement: 4, moyennePromo: 13, promoMax: 19, promoMin: 11}
            ]},
          {id: 42, moyenne: 15, classement : 10, moyennePromo: 11, promoMax: 19, promoMin: 9,
            matieres : [
              {nom:'PWEB2', moyenne: 11, classement: 24, moyennePromo: 12, promoMax: 14, promoMin: 7}
            ]},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
            matieres : [
              {nom:'Projet tutoré', moyenne: 13, classement: 14, moyennePromo: 14, promoMax: 16, promoMin: 6}
            ]}]
      }]},
  { id: 12, nom: 'Audin', prenom: 'Patrick', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 13, nom: 'Bertin', prenom: 'Sophie', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 14, nom: 'Varon', prenom: 'Julie', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 15, nom: 'Tapour', prenom: 'Jean-Pierre', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 16, nom: 'Prusier', prenom: 'Serge', s1: 13, s2: 1, s3: 4, s4: 14, avatar: 'images/homme.jpg', numero: 20172345,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 17, nom: 'Figier', prenom: 'Adam', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 18, nom: 'Bonno', prenom: 'Thierry', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 19, nom: 'Quantelier', prenom: 'Stéphane' , s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 20, nom: 'Hister', prenom: 'Louis', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]}
];

export const PROMO1 = [
  { id: 16, nom: 'Prusier', prenom: 'Serge' , s1: 13, s2: 1, s3: 4, s4: 14, avatar: 'app/homme.jpg', numero: 20172345,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 14, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 12, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 17, nom: 'Figier', prenom: 'Adam', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 18, nom: 'Bonno', prenom: 'Thierry', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 19, nom: 'Quantelier', prenom: 'Stéphane', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 20, nom: 'Hister', prenom: 'Louis', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]}
];

export const PROMO2 = [
  { id: 11, nom: 'Durant', prenom: 'Georges' , s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 12, nom: 'Audin', prenom: 'Patrick' , s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 13, nom: 'Bertin', prenom: 'Sophie', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 14, nom: 'Varon', prenom: 'Julie', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]},
  { id: 15, nom: 'Tapour', prenom: 'Jean-Pierre', s1: 13, s2: 1, s3: 4, s4: 14,  avatar: 'images/homme.jpg', numero: 1234567,
    semestre : [
      {id : 1 ,  moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9,
        UE : [
          {id: 11, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 12, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 2, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 21, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 22, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 3 ,moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 31, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 32, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 33, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      },
      {id : 4, moyenne: 11, classement : 27, moyennePromo: 9, promoMax: 16, promoMin: 5,
        UE : [
          {id: 41, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 42, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9},
          {id: 43, moyenne: 15, classement : 7, moyennePromo: 11, promoMax: 19, promoMin: 9}]
      }]}
];

export const PERSONNES2 = [
  PROMO1, PROMO2
];
