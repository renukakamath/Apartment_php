package com.example.apartmentmanagement;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONObject;

public class Viewappointment extends AppCompatActivity implements JsonResponse, AdapterView.OnItemClickListener {
    ListView l1;
    SharedPreferences sh;
    String[] hospital_name,fname,details,date,time,value,appid;
    public static String aid;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_viewappointment);
        l1=(ListView) findViewById(R.id.list);
        l1.setOnItemClickListener(this);
        sh= PreferenceManager.getDefaultSharedPreferences(getApplicationContext());
        JsonReq JR = new JsonReq();
        JR.json_response = (JsonResponse) Viewappointment.this;
        String q = "?action=Viewappointment&login_id="+sh.getString("log_id","" );
        q = q.replace(" ", "%20");
        JR.execute(q);
    }

    @Override
    public void response(JSONObject jo) {
        try {

            String status = jo.getString("status");
            Log.d("pearl", status);


            if (status.equalsIgnoreCase("success")) {
                JSONArray ja1 = (JSONArray) jo.getJSONArray("data");

                hospital_name =new String[ja1.length()];
                fname= new String[ja1.length()];
                details=new String[ja1.length()];
                date=new String[ja1.length()];
                time=new String[ja1.length()];
                appid=new String[ja1.length()];


                value=new String[ja1.length()];


                String[] value = new String[ja1.length()];

                for (int i = 0; i < ja1.length(); i++) {
                    hospital_name[i] = ja1.getJSONObject(i).getString("hospital_name");
                    fname[i] = ja1.getJSONObject(i).getString("fname");
                    details[i] = ja1.getJSONObject(i).getString("details");
                    date[i] = ja1.getJSONObject(i).getString("date");
                    time[i] = ja1.getJSONObject(i).getString("time");
                    appid[i] = ja1.getJSONObject(i).getString("appointment_id");



                    value[i] = "hospital name:" + hospital_name[i] + "\nname: " + fname[i] + "\ndetails: " + details[i] + "\ndate: " + date[i] +"\ntime:" +time[i];

                }
                ArrayAdapter<String> ar = new ArrayAdapter<String>(getApplicationContext(), R.layout.custtext, value);

                l1.setAdapter(ar);

            }
        } catch (Exception e) {
            // TODO: handle exception
            e.printStackTrace();
            Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_LONG).show();

        }
    }

    @Override
    public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {

        aid=appid[i];


        final CharSequence[] items = {"View Precaution", "Cancel"};

        AlertDialog.Builder builder = new AlertDialog.Builder(Viewappointment.this);
        builder.setItems(items, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int item) {


                if (items[item].equals("View Precaution")) {
                    startActivity(new Intent(getApplicationContext(), ViewPrecaution.class));

                } else if (items[item].equals("Cancel")) {
                    dialog.dismiss();
                }

            }

        });
        builder.show();
    }
    }
