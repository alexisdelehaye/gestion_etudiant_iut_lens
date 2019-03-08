import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {Personne} from '../personne';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {FileSystemFileEntry, UploadEvent, UploadFile} from 'ngx-file-drop';
import {PersonneService} from '../personne.service';
import {Router} from '@angular/router';

@Component({
    selector: 'app-form-personne',
    templateUrl: './form-personne.component.html',
    styleUrls: ['./form-personne.component.css']
})
export class FormPersonneComponent implements OnInit {
    @Input() personne: Personne;
    @Output() personneModifiee: EventEmitter<Personne>;
    personneForm: FormGroup;
    error: any;
    avatar: File;
    public file: UploadFile = null;
    public imagePreview;
    pageTitle: string;
    action: string;

    constructor(private fb: FormBuilder, private service: PersonneService,
                private router: Router) {
        this.createForm();
    }

    ngOnInit() {
        const id = this.personne.id;
        console.log('Valeur de l\'id : ', id);
        if (id === undefined) {
            this.pageTitle = 'Creation personne';
        } else {
            this.action = 'edit';
            this.pageTitle = 'Edition personne';
            this.personneForm.patchValue({
                nom: this.personne.nom,
                prenom: this.personne.prenom,
                telephone: this.personne.telephone,
                id: this.personne.id
            });
            this.avatar = this.personne.avatar;
        }
        console.log('Action: ', this.action);
    }

    createForm() {
        this.personneForm = this.fb.group({
            nom: [null, Validators.compose([Validators.required])],
            prenom: [null, Validators.compose([Validators.required])],
            telephone: [null, Validators.compose([Validators.required])],
            avatar: [null],
        });
    }

    get nom() {
        return this.personneForm.get('nom');
    }

    get prenom() {
        return this.personneForm.get('prenom');
    }

    get telephone() {
        return this.personneForm.get('telephone');
    }

    onSubmit(): void {
        if (this.action === 'edit') {
            Object.assign(this.personne, this.personneForm.value);
            this.service.onUpdate(this.personne, this.avatar).subscribe(                (response) => {
                    this.router.navigate(['/']);
                },
                (response) => {
                    if (response.status === 422) {
                        Object.keys(response.error).map((err) => {
                            this.error = `${response.error[err]}`;
                        });

                    } else {
                        this.error = response.error;
                    }
                }
            );
        } else {
            this.service.onCreate(this.avatar, this.personneForm.value).subscribe(
                (response) => {
                    this.router.navigate(['/']);
                },
                (response) => {
                    if (response.status === 422) {
                        Object.keys(response.error).map((err) => {
                            this.error = `${response.error[err]}`;
                        });

                    } else {
                        this.error = response.error;
                    }
                }
            );
        }
    }

    public dropped(event: UploadEvent) {
        this.file = event.files[0];
        if (this.file.fileEntry.isFile) {
            const fileEntry = this.file.fileEntry as FileSystemFileEntry;

            fileEntry.file((file: File) => {
                // Here you can access the real file
                console.log(this.file.relativePath, file);
                this.avatar = file;
                const reader = new FileReader();
                reader.onload = () => {
                    this.imagePreview = reader.result;
                };
                reader.readAsDataURL(file);
            });
        }
    }

    public fileOver(event) {
        console.log(event);
    }

    public fileLeave(event) {
        console.log(event);
    }

}
