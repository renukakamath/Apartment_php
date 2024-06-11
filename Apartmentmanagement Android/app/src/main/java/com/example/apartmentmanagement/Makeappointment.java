package com.example.apartmentmanagement;

import androidx.appcompat.app.AppCompatActivity;

import android.app.DatePickerDialog;
import android.app.TimePickerDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TimePicker;
import android.widget.Toast;

import org.json.JSONObject;

import java.util.Calendar;

public class Makeappointment extends AppCompatActivity implements JsonResponse{
    EditText e1,e2,e3;
    Button b1;
    String date,time,description;
    SharedPreferences sh;
    private int mYear, mMonth, mDay, mHour, mMinute;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_makeappointment);
        sh=PreferenceManager.getDefaultSharedPreferences(getApplicationContext());

        e1=(EditText) findViewById(R.id.date);
        e2=(EditText) findViewById(R.id.time);
        e3=(EditText) findViewById(R.id.description);
        b1=(Button) findViewById(R.id.app);

        final Calendar calendar=Calendar.getInstance() ;
        final int mYear = calendar.get(calendar.YEAR);
        final int mMonth =calendar.get(calendar.MONTH);
        final  int mDay =calendar.get(calendar.DAY_OF_MONTH);


        e1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                DatePickerDialog dialog =new DatePickerDialog(Makeappointment.this, new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker view, int year,
                                          int monthOfYear, int dayOfMonth) {

                        e1.setText(dayOfMonth + "-" + (monthOfYear + 1) + "-" + year);

                    }
                }, mYear, mMonth, mDay);
                dialog.show();
            }
        });



        e2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Calendar mcurrentTime = Calendar.getInstance();
                int hour = mcurrentTime.get(Calendar.HOUR_OF_DAY);
                int minute = mcurrentTime.get(Calendar.MINUTE);

                TimePickerDialog mTimePicker;
                mTimePicker = new TimePickerDialog(Makeappointment.this, new TimePickerDialog.OnTimeSetListener() {
                    @Override
                    public void onTimeSet(TimePicker timePicker, int selectedHour, int selectedMinute) {
                        e2.setText( selectedHour + ":" + selectedMinute);
                    }
                }, hour, minute, true);
                mTimePicker.setTitle("Select Time");
                mTimePicker.show();

            }
        });


        b1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                date=e1.getText().toString();
                time=e2.getText().toString();
                description=e3.getText().toString();



                JsonReq JR = new JsonReq();
                JR.json_response = (JsonResponse) Makeappointment.this;
                String q ="?action=Makeappointment&date=" + date +"&time="+time +"&description="+description +"&hid=" + Viewhospital.hid +"&login_id="+sh.getString("log_id","" ) ;
                q = q.replace(" ","%20");
                JR.execute(q);


            }
        });



    }

    @Override
    public void response(JSONObject jo) {
        try {
            String status = jo.getString("status");
            Log.d("pearl", status);


            if (status.equalsIgnoreCase("success")) {
                Toast.makeText(getApplicationContext(), " SUCCESS", Toast.LENGTH_LONG).show();
                startActivity(new Intent(getApplicationContext(), Userhome.class));

            }

        } catch (Exception e) {
            // TODO: handle exception
            e.printStackTrace();
            Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();
        }
    }
}