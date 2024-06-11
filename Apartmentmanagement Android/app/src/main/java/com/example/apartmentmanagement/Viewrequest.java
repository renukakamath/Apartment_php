package com.example.apartmentmanagement;

import androidx.appcompat.app.AppCompatActivity;

import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONObject;

public class Viewrequest extends AppCompatActivity implements JsonResponse{
    ListView l1;
    SharedPreferences sh;
    String [] service_name,fname,statu,value;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_viewrequest);
        l1=(ListView) findViewById(R.id.list);
        sh= PreferenceManager.getDefaultSharedPreferences(getApplicationContext());
        JsonReq JR = new JsonReq();
        JR.json_response = (JsonResponse) Viewrequest.this;
        String q = "?action=Viewrequest&login_id="+sh.getString("log_id","" );
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
                fname= new String[ja1.length()];
                statu=new String[ja1.length()];

                value=new String[ja1.length()];


                String[] value = new String[ja1.length()];

                for (int i = 0; i < ja1.length(); i++) {
                    service_name[i] = ja1.getJSONObject(i).getString("service_name");
                    fname[i] = ja1.getJSONObject(i).getString("fname");
                    statu[i] = ja1.getJSONObject(i).getString("status");


                    value[i] = "service name:" + service_name[i] + "\nname: " + fname[i] + "\nstatus: " + statu[i] ;

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
}