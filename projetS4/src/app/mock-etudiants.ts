import {Etudiant} from './etudiant-model';
export const ETUDIANTS: Etudiant[] = [
  new Etudiant({
    id: 1,
    nom: 'Virey',
    prenom: 'Pierre Louis',
    avatar : 'virey_pierre-louis.jpg',
    groupe : 'IPI',
    s1: 15,
    s2: 10,
    s3: 7.9,
    s4 : 10,
    ue41 : 11,
    ue42 : 12,
    ue43 : 13,
    ue31 : 8.9,
    ue32 : 8.7,
    ue33 : 8.6,
    ue21 : 11,
    ue22 : 12,
    ue11 : 13,
    ue12 : 14,
    semestres : {'S1': {'Algo':7,'BD':9}}
  }),
  new Etudiant({
    id: 2,
    nom: 'Warlouzet',
    prenom: 'Cloe',
    avatar : 'warlouzet_cloe.jpg',
    groupe : 'PEL',
    s1: 17,
    s2: 5,
    s3: 8,
    s4: 9.9,
    ue41 : 1,
    ue42 : 2,
    ue43 : 3,
    ue31 : 11,
    ue32 : 12,
    ue33 : 13,
    ue21 : 10.7,
    ue22 : 15.7,
    ue11 : 18,
    ue12 : 16.5,
    semestres : {'S1': {'Anglais':16,'Com':12}}
  })
];
