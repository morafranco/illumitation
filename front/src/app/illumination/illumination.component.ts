import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders  } from '@angular/common/http';

@Component({
  selector: 'app-illumination',
  templateUrl: './illumination.component.html',
  styleUrls: ['./illumination.component.css']
})
export class IlluminationComponent implements OnInit {

  matrix: any;
  originalMatrix: any;

  constructor(private http: HttpClient) { 

  }

  ngOnInit(): void {
  }

  selectFile(ctrlFile: any) {
    var file = ctrlFile.files[0];
    let formData = new FormData();
    formData.append("file", file);


    this.http.post('http://localhost:8007/api/calculate',formData).subscribe(data => {
      this.matrix = data
    })

  }

}
