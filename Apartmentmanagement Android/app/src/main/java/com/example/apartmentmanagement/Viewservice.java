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

public class Viewservice extends AppCompatActivity implements JsonResponse, AdapterView.OnItemClickListener {
    ListView l1;
    SharedPreferences sh;
    String[] service_name,phone,description,value,service_id;
    public static String sid;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_viewservice);
        l1=(ListView) findViewById(R.id.list);
        l1.setOnItemClickListener(this);
        sh= PreferenceManager.getDefaultSharedPreferences(getApplicationContext());
        JsonReq JR = new JsonReq();
        JR.json_response = (JsonResponse) Viewservice.this;
        String q = "?action=Viewservice&login_id="+sh.getString("log_id","" );
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

                service_name =new String[ja1.length()];
                service_id=new String[ja1.length()];
                phone= new String[ja1.length()];
                description=new String[ja1.length()];

                value=new String[ja1.length()];


                String[] value = new String[ja1.length()];

                for (int i = 0; i < ja1.length(); i++) {
                    service_name[i] = ja1.getJSONObject(i).getString("service_name");
                    phone[i] = ja1.getJSONObject(i).getString("phone");
                    description[i] = ja1.getJSONObject(i).getString("description");
                    service_id[i] = ja1.getJSONObject(i).getString("service_id");


                    value[i] = "service name:" + service_name[i] + "\nphone: " + phone[i] + "\ndescription: " + description[i] ;

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
        sid=service_id[i];

        final CharSequence[] items = {"Send Request", "Cancel"};

        AlertDialog.Builder builder = new AlertDialog.Builder(Viewservice.this);
        builder.setItems(items, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int item) {

                if (items[item].equals("Send Request")) {

                    JsonReq JR = new JsonReq();
                    JR.json_response = (JsonResponse) Viewservice.this;
                    String q = "?action=Sendrequest&sid="+sid+"&login_id="+sh.getString("log_id","" );
                    q = q.replace(" ", "%20");
                    JR.execute(q);
                    Toast.makeText(getApplicationContext(), " SUCCESSFULLY SEND REQUEST", Toast.LENGTH_LONG).show();

                } else if (items[item].equals("Cancel")) {
                    dialog.dismiss();
                }
            }

        });
        builder.show();


    }

}