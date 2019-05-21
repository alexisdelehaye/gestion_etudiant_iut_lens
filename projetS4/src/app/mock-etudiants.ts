import {Etudiant} from './etudiant-model';
export const ETUDIANTS: Etudiant[] = [
  new Etudiant({
    id: 1,
    nom: 'Virey',
    prenom: 'Pierre Louis',
    avatar : 'virey_pierre-louis.jpg',
    s1: 15,
    s2: 10,
    s3: 7.9
    // semestres : {'S1':10, 'S2':15, 'S3': 19, 'S4':15}
  }),
  new Etudiant({
    id: 2,
    nom: 'Warlouzet',
    prenom: 'Cloe',
    avatar : 'warlouzet_cloe.jpg',
    s1: 17,
    s2: 5,
    s3: 8
    //semestres : {'S1':10.6, 'S2':13.5, 'S3': 9, 'S4':7.5}
  })
];
