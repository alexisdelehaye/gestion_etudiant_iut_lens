/**
 * Created by hsu on 21/05/19.
 */
import {Semestre} from './semestre-modele';

export class Etudiant {

  id : number;
  nom : string;
  prenom : string;
  avatar : string;
  groupe : string;
  //semestres ? : any;
  s1 : number;
  s2 : number;
  s3 : number;
  s4 : number;
  ue41 : number;
  ue42 : number;
  ue43 : number;
  ue31 : number;
  ue32 : number;
  ue33 : number;
  ue21 : number;
  ue22 : number;
  ue11 : number;
  ue12 : number;
  semestre : any;

  constructor(values: Object = {}) {
    Object.assign(<Etudiant>this, values);
  }
}
