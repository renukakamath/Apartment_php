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

public class Viewhospital extends AppCompatActivity implements JsonResponse, AdapterView.OnItemClickListener {
    ListView l1;
    SharedPreferences sh;
    String[] hospital_name,phone,email,place,value,hospital_id;
    public  static  String hid;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_viewhospital);
        l1=(ListView) findViewById(R.id.list);
        l1.setOnItemClickListener(this);
        sh= PreferenceManager.getDefaultSharedPreferences(getApplicationContext());
        JsonReq JR = new JsonReq();
        JR.json_response = (JsonResponse) Viewhospital.this;
        String q = "?action=Viewhospital&login_id="+sh.getString("log_id","" );
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
                phone= new String[ja1.length()];
                email=new String[ja1.length()];
                place=new String[ja1.length()];
                hospital_id=new String[ja1.length()];

                value=new String[ja1.length()];


                String[] value = new String[ja1.length()];

                for (int i = 0; i < ja1.length(); i++) {
                    hospital_name[i] = ja1.getJSONObject(i).getString("hospital_name");
                    phone[i] = ja1.getJSONObject(i).getString("phone");
                    email[i] = ja1.getJSONObject(i).getString("email");
                    place[i] = ja1.getJSONObject(i).getString("place");
                    hospital_id[i] = ja1.getJSONObject(i).getString("hospital_id");



                    value[i] = "hospital name:" + hospital_name[i] + "\nphone: " + phone[i] + "\nemail: " + email[i] + "\nplace: " + place[i];

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
        hid=hospital_id[i];

        final CharSequence[] items = {"Make Appointment", "Cancel"};

        AlertDialog.Builder builder = new AlertDialog.Builder(Viewhospital.this);
        builder.setItems(items, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int item) {


                if (items[item].equals("Make Appointment")) {
                    startActivity(new Intent(getApplicationContext(), Makeappointment.class));

                } else if (items[item].equals("Cancel")) {
                    dialog.dismiss();
                }

            }

        });
        builder.show();
    }
    }
