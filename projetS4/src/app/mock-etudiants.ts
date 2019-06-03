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
    ue12 : 6,
    semestres : {   's1': {
                             'ue11' : {'Algo': 7, 'BD': 9},
                             'ue12' : {'Anglais':10, 'Com':10.5}
                          },
                     's2':{
                             'ue11': {'Archi': 17, 'POO': 10},
                             'ue12' :{'Anglais':10, 'Com':10.5}
                          }

                }
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
    ue11 : 8,
    ue12 : 16.5,
    semestres : {
      's1': {'ue11' : {'Algo': 9, 'BD': 10}, 'ue12' : {'Ang1':10.9, 'Com':12.5} },
      's2': {'ue21': {'Archi': 6, 'POO': 9}, 'ue22' :{'Ang2':16, 'Com':10}      },
      's3': {'ue31': {'CPA': 16, 'SE3': 10.6}, 'ue32' :{'Proba':12, 'Ang3':13.5} }
    }
  })
];
