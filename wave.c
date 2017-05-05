#include <stdio.h>
#include <math.h>
#include "wave.h"
#include "comm.h"
#include <string.h>
#define RESS 8

void printout(char s[4]){
	int i;
	for (i=0;i<=3;i++)
		printf("%c",s[i]);
	printf("\n");
}

void WAVinfo(WAVHDR d){
	printf("Chunk ID: "); printout(d.ChunkID);
	printf("ChunkSize: %i\n",d.ChunkSize);
	printf("Format: ");printout(d.Format);
	printf("Subchunk1ID: ");printout(d.Subchunk1ID);
	printf("Subchunk1Size: %i\n",d.Subchunk1Size);
	printf("Audio Format: %i\n", d.AudioFormat);
	printf("Num Channels: %i\n",d.NumChannels);
	printf("Sample Rate: %i\n",d.SampleRate);
	printf("Byte Rate: %i\n",	d.ByteRate);
	printf("Block Align: %i\n",d.BlockAlign);
	printf("Bits Per Sample: %i\n",d.BitsPerSample);
	printf("Subchunk2ID: ");printout(d.Subchunk2ID);
	printf("Subchunk2Size: %i\n",d.Subchunk2Size);
	printf("Number of Samples: %i\n",d.Subchunk2Size*8/(d.NumChannels*d.BitsPerSample));
}

void sendWAV(short int* s){
	int i=1, size_pack=SAMPLE_RATE/RESS;
	char data[1000]="data=";
	char subdata[20];
	double rms=0.0;
	long long sum_rms;
	for (i=0;i<RESS;i++)
	{
		int j, k=i*size_pack;
		sum_rms=0;
		for (j=k;j<k+size_pack;j++)
			sum_rms+=s[j]*s[j];
		rms = sqrt(1.0*sum_rms/size_pack);
		if (rms<=1)
			rms=0;
		else
			rms = 20*log10(rms);
		sprintf(subdata,"%.2lf ",rms);
		strcat(data,subdata);
	}
	printf("%s",data);
	send_post(SERVER_URL,data);
}
