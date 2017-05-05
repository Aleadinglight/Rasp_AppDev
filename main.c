// This file is used to analyse the *.wav file
#include <stdio.h>
#include <signal.h>
#include <sys/wait.h>
#include <stdlib.h>
#include "wave.h"

void clrscr(){
	printf("\033[2J");
	fflush(stdout);
}

int main(int argc, char *argv[]){
	FILE* f;
	WAVHDR d;
	int ret;
	short int sa[SAMPLE_RATE];
	while (1){
		ret = system("arecord -q -r16000 -c1 -d1 -f S16_LE data.wav");
		if (WIFSIGNALED(ret) && WTERMSIG(ret)==SIGINT) {
			clrscr();
			break;
		}
		clrscr();
/*	
	if (argc<2){
		printf("Usage: %s wav_file\n", argv[0]);
		return -1;
	}
*/
		f = fopen("data.wav", "r");
		if (f==NULL){
			printf("Cant open the file!\n");
			return -1;
		}
		fread(&d,sizeof(d),1,f);
		//WAVinfo(d);
		fread(&sa, sizeof(short int), SAMPLE_RATE, f);
		sendWAV(sa);
		fclose(f);
	}
	return 0;
}