import {Etudiant} from './etudiant-model';
export const ETUDIANTS: Etudiant[] = [
  new Etudiant({
    id: 1,
    nom: 'Virey',
    prenom: 'Pierre Louis',
    avatar : 'virey_pierre-louis.jpg',
    s1: 15,
    s2: 10,
    s3: 7.9,
    s4 : 10,
    semestres : {'S1': {'Algo':10,'BD':15}}
  }),
  new Etudiant({
    id: 2,
    nom: 'Warlouzet',
    prenom: 'Cloe',
    avatar : 'warlouzet_cloe.jpg',
    s1: 17,
    s2: 5,
    s3: 8,
    s4: 9.9,
    semestres : {'S1': {'Anglais':16,'Com':12}}
  })
];
