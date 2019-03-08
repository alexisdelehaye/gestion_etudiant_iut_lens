import {Component} from '@angular/core';
import {FileSystemDirectoryEntry, FileSystemFileEntry, UploadEvent, UploadFile} from 'ngx-file-drop';
import {FileUploadService} from './file-upload.service';

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.css']
})
export class AppComponent {
    title = 'projet-upload-file';
    public files: UploadFile[] = [];
    public imagePreview;

    constructor(private service: FileUploadService) {
    }

    public dropped(event: UploadEvent) {
        this.files = event.files;
        for (const droppedFile of event.files) {
            // Is it a file?
            if (droppedFile.fileEntry.isFile) {
                const fileEntry = droppedFile.fileEntry as FileSystemFileEntry;

                fileEntry.file((file: File) => {
                    // Here you can access the real file
                    console.log(droppedFile.relativePath, file);
                    const reader = new FileReader();
                    reader.onload = () => {
                        this.imagePreview = reader.result;
                    };
                    reader.readAsDataURL(file);
                    /*
                                      const formData = new FormData();
                                      formData.append('avatar', file, droppedFile.relativePath);
                                      this.service.sendFile(formData);
                  */
                });
            } else {
                // It was a directory (empty directories are added, otherwise only files)
                const fileEntry = droppedFile.fileEntry as FileSystemDirectoryEntry;
                console.log(droppedFile.relativePath, fileEntry);
            }
        }
    }

    public fileOver(event) {
        console.log(event);
    }

    public fileLeave(event) {
        console.log(event);
    }


    /**
     // You could upload it like this:
     const formData = new FormData()
     formData.append('logo', file, relativePath)

     // Headers
     const headers = new HttpHeaders({
            'security-token': 'mytoken'
          })

     this.http.post('https://mybackend.com/api/upload/sanitize-and-save-logo', formData, { headers: headers, responseType: 'blob' })
     .subscribe(data => {
            // Sanitized logo returned from backend
          })
     **/


}
